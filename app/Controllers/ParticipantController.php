<?php

namespace App\Controllers;

use App\Models\ParticipantModel;
use App\Models\MeetingModel;

class ParticipantController extends BaseController
{
    /**
     * Helper: ambil user_id dari session
     */
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

        // Verifikasi meeting milik user ini
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->where('id', $meetingId)->where('user_id', $userId)->first();
        
        if (!$meeting) {
            return $this->response->setJSON([]);
        }

        $model = new ParticipantModel();
        return $this->response->setJSON(
            $model->where('meeting_id', $meetingId)->where('user_id', $userId)->findAll()
        );
    }

    public function addParticipant()
    {
        $userId = $this->getUserId();
        $meetingId = $this->request->getPost('meeting_id');

        // Verifikasi meeting milik user ini
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->where('id', $meetingId)->where('user_id', $userId)->first();
        
        if (!$meeting) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Meeting tidak ditemukan']);
        }

        $model = new ParticipantModel();
        
        // Cek apakah barcode_id sudah ada di meeting yang sama
        $existing = $model->where('barcode_id', $this->request->getPost('barcode_id'))
                          ->where('meeting_id', $meetingId)
                          ->first();
        
        if ($existing) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Barcode ID sudah terdaftar di meeting ini']);
        }

        $data = [
            'user_id'    => $userId,
            'meeting_id' => $meetingId,
            'name'       => $this->request->getPost('name'),
            'barcode_id' => $this->request->getPost('barcode_id'),
            'status'     => 'belum_hadir'
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Peserta berhasil ditambahkan']);
    }

    public function scanBarcode()
    {
        $model = new ParticipantModel();
        $userId = $this->getUserId();
        $barcode = $this->request->getPost('barcode');
        
        // Cari peserta berdasarkan barcode DAN user_id
        $participant = $model->where('barcode_id', $barcode)
                            ->where('user_id', $userId)
                            ->first();

        if (!$participant) {
            return $this->response->setJSON([
                'status' => 'not_found', 
                'message' => 'Barcode tidak ditemukan dalam data peserta Anda'
            ]);
        }

        // Cek apakah sudah hadir
        if ($participant['status'] === 'hadir') {
            return $this->response->setJSON([
                'status' => 'already_present',
                'message' => $participant['name'] . ' sudah tercatat hadir sebelumnya'
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
        $barcode = $this->request->getPost('barcode');
        $meetingId = $this->request->getPost('meeting_id');
        $userId = $this->getUserId();

        // Verifikasi meeting milik user ini
        $meetingModel = new MeetingModel();
        $meeting = $meetingModel->where('id', $meetingId)->where('user_id', $userId)->first();
        
        if (!$meeting) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Meeting tidak ditemukan'
            ]);
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

        // Cek apakah sudah hadir
        if ($participant['status'] === 'hadir') {
            return $this->response->setJSON([
                'success' => true, 
                'message' => $participant['name'] . ' sudah tercatat hadir sebelumnya',
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
