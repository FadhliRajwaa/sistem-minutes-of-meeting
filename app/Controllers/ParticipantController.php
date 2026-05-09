<?php

namespace App\Controllers;

use App\Models\ParticipantModel;
use App\Models\MeetingModel;

class ParticipantController extends BaseController
{
    private function getUserId(): int
    {
        return (int) session()->get('user')['id'];
    }

    public function index()
    {
        return view('partials/participant-content');
    }

    public function getParticipants($meetingId)
    {
        $userId = $this->getUserId();

        // Verifikasi meeting milik user
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->select('id')
            ->where('id', $meetingId)
            ->where('user_id', $userId)
            ->first();
        
        if (!$meeting) {
            return $this->response->setJSON([]);
        }

        $model = new ParticipantModel();
        $participants = $model->select('id, name, barcode_id, status, scanned_at')
            ->where('meeting_id', $meetingId)
            ->where('user_id', $userId)
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->response
            ->setHeader('Cache-Control', 'private, max-age=3')
            ->setJSON($participants);
    }

    public function addParticipant()
    {
        $userId = $this->getUserId();
        $meetingId = $this->request->getPost('meeting_id');
        $name = trim($this->request->getPost('name') ?? '');
        $barcodeId = trim($this->request->getPost('barcode_id') ?? '');

        // Validasi input
        if (empty($meetingId) || empty($name) || empty($barcodeId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Semua field harus diisi']);
        }

        // Verifikasi meeting milik user
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->select('id')->where('id', $meetingId)->where('user_id', $userId)->first();
        if (!$meeting) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Meeting tidak ditemukan']);
        }

        $model = new ParticipantModel();
        
        // Cek duplikasi barcode di meeting yang sama
        $existing = $model->where('barcode_id', $barcodeId)
                          ->where('meeting_id', $meetingId)
                          ->first();
        
        if ($existing) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Barcode ID sudah terdaftar di meeting ini']);
        }

        $model->insert([
            'user_id'    => $userId,
            'meeting_id' => $meetingId,
            'name'       => $name,
            'barcode_id' => $barcodeId,
            'status'     => 'belum_hadir'
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Peserta berhasil ditambahkan']);
    }

    public function scanBarcode()
    {
        $model = new ParticipantModel();
        $userId = $this->getUserId();
        $barcode = trim($this->request->getPost('barcode') ?? '');
        
        if (empty($barcode)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Barcode tidak valid']);
        }

        $participant = $model->where('barcode_id', $barcode)
                            ->where('user_id', $userId)
                            ->first();

        if (!$participant) {
            return $this->response->setJSON([
                'status' => 'not_found', 
                'message' => 'Barcode tidak ditemukan dalam data peserta Anda'
            ]);
        }

        if ($participant['status'] === 'hadir') {
            return $this->response->setJSON([
                'status' => 'already_present',
                'message' => $participant['name'] . ' sudah tercatat hadir'
            ]);
        }

        $model->update($participant['id'], [
            'status' => 'hadir', 
            'scanned_at' => date('Y-m-d H:i:s')
        ]); 
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => $participant['name'] . ' berhasil diabsen'
        ]);
    }

    public function absen()
    {
        $barcode = trim($this->request->getPost('barcode') ?? '');
        $meetingId = $this->request->getPost('meeting_id');
        $userId = $this->getUserId();

        if (empty($barcode) || empty($meetingId)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
        }

        // Verifikasi meeting milik user
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->select('id')->where('id', $meetingId)->where('user_id', $userId)->first();
        if (!$meeting) {
            return $this->response->setJSON(['success' => false, 'message' => 'Meeting tidak ditemukan']);
        }

        $model = new ParticipantModel();
        $participant = $model->where('barcode_id', $barcode)
                             ->where('meeting_id', $meetingId)
                             ->where('user_id', $userId)
                             ->first();

        if (!$participant) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Peserta dengan barcode tersebut tidak ditemukan di meeting ini'
            ]);
        }

        if ($participant['status'] === 'hadir') {
            return $this->response->setJSON([
                'success' => true, 
                'message' => $participant['name'] . ' sudah tercatat hadir',
                'already_present' => true
            ]);
        }

        $model->update($participant['id'], [
            'status' => 'hadir', 
            'scanned_at' => date('Y-m-d H:i:s')
        ]);
        
        return $this->response->setJSON([
            'success' => true, 
            'message' => $participant['name'] . ' berhasil diabsen'
        ]);
    }
}
