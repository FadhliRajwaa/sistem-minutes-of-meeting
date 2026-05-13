<?php

namespace App\Controllers;

use App\Models\DiscussionModel;
use App\Models\MeetingModel;
use App\Models\ParticipantModel;

class ExportController extends BaseController
{
    public function index()
    {
        $model = new DiscussionModel();
        // Hanya tampilkan diskusi milik user ini
        $data['discussions'] = $model->where('user_id', $this->getUserId())->findAll();

        return view('partials/export-content', $data);
    }

    public function generatePDF($id = null)
    {
        // Jika ID tidak dikirim lewat URL (GET), cek dari POST body
        if (!$id) {
            $id = $this->request->getPost('discussion_id');
        }

        if (!$id) {
            return $this->response->setStatusCode(400)->setBody('ID diskusi tidak diberikan.');
        }

        $userId = $this->getUserId();
        $model = new DiscussionModel();

        // Pastikan discussion milik user ini
        $discussion = $model->where('id', $id)->where('user_id', $userId)->first();

        if (!$discussion) {
            return $this->response->setStatusCode(404)->setBody('Data diskusi tidak ditemukan.');
        }

        // Ambil data meeting terkait (dengan filter user_id)
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->where('id', $discussion['meeting_id'])
                                ->where('user_id', $userId)
                                ->first();

        if (!$meeting) {
            return $this->response->setStatusCode(404)->setBody('Data meeting tidak ditemukan.');
        }

        // Ambil data peserta (dengan filter user_id)
        $participantModel = new ParticipantModel();
        $participants = $participantModel->where('meeting_id', $discussion['meeting_id'])
                                        ->where('user_id', $userId)
                                        ->findAll();

        $data = [
            'discussion' => $discussion,
            'meeting' => $meeting,
            'participants' => $participants
        ];

        try {
            $dompdf = new \Dompdf\Dompdf();
            $html = view('pdf/discussion', $data);
            
            $options = $dompdf->getOptions();
            $options->set('isRemoteEnabled', false);
            
            $tmpDir = sys_get_temp_dir();
            $options->set('fontDir', $tmpDir);
            $options->set('fontCache', $tmpDir);
            $options->set('tempDir', $tmpDir);
            $options->set('chroot', FCPATH); 
            $options->set('isFontSubsettingEnabled', false);

            $dompdf->setOptions($options);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $isPreview = $this->request->getGet('preview') === 'true';
            
            $pdfOutput = $dompdf->output();
            
            $response = $this->response;
            $response->setContentType('application/pdf');
            $response->setHeader('Content-Length', strlen($pdfOutput));
            $response->setHeader('Cache-Control', 'public, must-revalidate, max-age=0');
            $response->setHeader('Pragma', 'public');
            $response->setHeader('X-Content-Type-Options', 'nosniff');
            
            if ($isPreview) {
                $response->setHeader('Content-Disposition', 'inline; filename="notulen_rapat.pdf"');
            } else {
                $response->setHeader('Content-Disposition', 'attachment; filename="notulen_rapat.pdf"');
            }
            
            $response->setBody($pdfOutput);
            return $response;

        } catch (\Throwable $e) {
            log_message('error', 'PDF generation failed: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setBody('Maaf, gagal membuat PDF. Silakan coba lagi nanti.');
        }
    }

    /**
     * Preview as HTML (no PDF, no download)
     */
    public function previewHTML($id = null)
    {
        if (!$id) {
            return $this->response->setStatusCode(400)->setBody('ID diskusi tidak diberikan.');
        }

        $userId = $this->getUserId();
        $model = new DiscussionModel();

        // Pastikan discussion milik user ini
        $discussion = $model->where('id', $id)->where('user_id', $userId)->first();

        if (!$discussion) {
            return $this->response->setStatusCode(404)->setBody('Data diskusi tidak ditemukan.');
        }

        // Ambil data meeting terkait (dengan filter user_id)
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->where('id', $discussion['meeting_id'])
                                ->where('user_id', $userId)
                                ->first();

        if (!$meeting) {
            return $this->response->setStatusCode(404)->setBody('Data meeting tidak ditemukan.');
        }

        // Ambil data peserta (dengan filter user_id)
        $participantModel = new ParticipantModel();
        $participants = $participantModel->where('meeting_id', $discussion['meeting_id'])
                                        ->where('user_id', $userId)
                                        ->findAll();

        $data = [
            'discussion' => $discussion,
            'meeting' => $meeting,
            'participants' => $participants
        ];

        return view('pdf/discussion', $data);
    }
}
