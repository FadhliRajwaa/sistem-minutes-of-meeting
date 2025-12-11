<?php

namespace App\Controllers;

use App\Models\DiscussionModel;
use Dompdf\Dompdf;

class ExportController extends BaseController
{
    public function index()
{
    $model = new \App\Models\DiscussionModel();
    $data['discussions'] = $model->findAll();

    return view('partials/export-content', $data);
}

    public function generatePDF($id = null)
    {
        // Jika ID tidak dikirim lewat URL (GET), cek dari POST body
        if (!$id) {
            $id = $this->request->getPost('discussion_id');
        }

        if (!$id) {
            return "ID diskusi tidak diberikan.";
        }

        $model = new \App\Models\DiscussionModel();
        $discussion = $model->find($id);

        if (!$discussion) {
            return "Data diskusi tidak ditemukan.";
        }
        
        // Ambil data meeting terkait
        $meetingModel = new \App\Models\MeetingModel();
        $meeting = $meetingModel->find($discussion['meeting_id']);
        
        // Ambil data peserta hadir
        $participantModel = new \App\Models\ParticipantModel();
        $participants = $participantModel->where('meeting_id', $discussion['meeting_id'])->findAll();

        $data = [
            'discussion' => $discussion,
            'meeting' => $meeting,
            'participants' => $participants
        ];

        // Fix Vercel: /tmp path for fonts
        // GD Extension check is handled in the View (pdf/discussion.php)
        
        try {
            $dompdf = new \Dompdf\Dompdf();
            $html = view('pdf/discussion', $data);
            
            $options = $dompdf->getOptions();
            $options->set('isRemoteEnabled', true);
            
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

            // Cek parameter 'preview' dari URL
            $isPreview = $this->request->getGet('preview') === 'true';
            
            // Get PDF output
            $pdfOutput = $dompdf->output();
            
            // Use CodeIgniter Response for proper header control
            $response = $this->response;
            $response->setContentType('application/pdf');
            
            if ($isPreview) {
                // Inline display (preview in browser)
                $response->setHeader('Content-Disposition', 'inline; filename="notulen_rapat.pdf"');
            } else {
                // Force download
                $response->setHeader('Content-Disposition', 'attachment; filename="notulen_rapat.pdf"');
            }
            
            $response->setBody($pdfOutput);
            return $response;

        } catch (\Throwable $e) {
            // In production, we might want to log this instead of showing it
            // But for now, let's show a user-friendly error
            return "Maaf, gagal membuat PDF. Server Error: " . $e->getMessage();
        }
    }

}
