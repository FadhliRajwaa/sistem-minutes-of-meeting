<?php

namespace App\Controllers;

use App\Models\DiscussionModel;
use App\Models\MeetingModel;

class DiscussionController extends BaseController
{
    public function index()
    {
        $meetingModel = new MeetingModel();
        $data['meetings'] = $meetingModel
            ->select('id, nama_meeting')
            ->where('user_id', $this->getUserId())
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('partials/discussion-content', $data);
    }

    public function save()
    {
        $userId = $this->getUserId();
        $meetingId = $this->request->getPost('meeting_id');
        $topik = trim($this->request->getPost('topik') ?? '');
        $pembahasan = $this->request->getPost('pembahasan');
        $tanggal = $this->request->getPost('tanggal');
        $namaNotulis = trim($this->request->getPost('nama_notulis') ?? '');

        // Validasi
        if (empty($meetingId) || empty($topik) || empty($pembahasan) || empty($tanggal) || empty($namaNotulis)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Semua field wajib diisi']);
        }

        // Validasi panjang
        if (strlen($topik) > 500 || strlen($namaNotulis) > 255) {
            return $this->response->setJSON(['success' => false, 'message' => 'Topik maksimal 500 karakter, nama notulis maksimal 255 karakter']);
        }

        // Validasi format tanggal
        $tanggal = trim($tanggal);
        if (!preg_match('/^\d{4}-\d{2}-\d{2}([ T]\d{2}:\d{2}(:\d{2})?)?$/', $tanggal) || strtotime($tanggal) === false) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format tanggal tidak valid']);
        }

        // Verifikasi meeting milik user
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->where('id', $meetingId)->where('user_id', $userId)->first();
        if (!$meeting) {
            return $this->response->setJSON(['success' => false, 'message' => 'Meeting tidak ditemukan']);
        }

        // Filter pembahasan kosong dan batasi jumlah
        if (is_array($pembahasan)) {
            $pembahasan = array_values(array_filter($pembahasan, fn($p) => trim($p) !== ''));
            if (count($pembahasan) > 100) {
                return $this->response->setJSON(['success' => false, 'message' => 'Maksimal 100 item pembahasan']);
            }
        }

        $discussionModel = new DiscussionModel();
        $discussionModel->save([
            'user_id'      => $userId,
            'meeting_id'   => $meetingId,
            'topik'        => $topik,
            'pembahasan'   => json_encode($pembahasan),
            'tanggal'      => $tanggal,
            'nama_notulis' => $namaNotulis
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Notulensi berhasil disimpan!']);
    }

    public function search()
    {
        $keyword = trim($this->request->getGet('keyword') ?? '');
        $userId = $this->getUserId();

        if (empty($keyword)) {
            // Return semua data user jika keyword kosong
            $model = new DiscussionModel();
            $data = $model->select('id, topik, nama_notulis, tanggal')
                          ->where('user_id', $userId)
                          ->orderBy('tanggal', 'DESC')
                          ->findAll();
            return $this->response->setJSON($data);
        }

        $model = new DiscussionModel();
        $data = $model->select('id, topik, nama_notulis, tanggal')
                    ->where('user_id', $userId)
                    ->groupStart()
                        ->like('topik', $keyword)
                        ->orLike('nama_notulis', $keyword)
                        ->orLike('tanggal', $keyword)
                    ->groupEnd()
                    ->orderBy('tanggal', 'DESC')
                    ->findAll();

        return $this->response
            ->setHeader('Cache-Control', 'private, max-age=5')
            ->setJSON($data);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            // Fallback: try JSON body
            $json = $this->request->getJSON();
            $id = $json->id ?? null;
        }

        if (!$id) {
            return $this->response->setStatusCode(422)->setJSON(['success' => false, 'message' => 'ID tidak valid']);
        }

        $userId = $this->getUserId();
        $model = new DiscussionModel();

        $discussion = $model->where('id', $id)->where('user_id', $userId)->first();
        if (!$discussion) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        if ($model->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data']);
    }
}
