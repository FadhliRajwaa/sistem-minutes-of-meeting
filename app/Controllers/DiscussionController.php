<?php

namespace App\Controllers;

use App\Models\DiscussionModel;
use App\Models\MeetingModel;

class DiscussionController extends BaseController
{
    public function index()
    {
        $discussionModel = new DiscussionModel();
        $meetingModel = new MeetingModel();

        $data['meetings'] = $meetingModel->findAll();

        return view('partials/discussion-content', $data);
    }

    public function save()
    {
        $discussionModel = new \App\Models\DiscussionModel();

        $pembahasan = $this->request->getPost('pembahasan');
        $pembahasanJson = json_encode($pembahasan);

        $discussionModel->save([
            'meeting_id' => $this->request->getPost('meeting_id'),
            'topik' => $this->request->getPost('topik'),
            'pembahasan' => $pembahasanJson,
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_notulis' => $this->request->getPost('nama_notulis')
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Berhasil disimpan!']);
    }

        public function search()
    {
        $keyword = $this->request->getGet('keyword');

        $model = new DiscussionModel();

        $data = $model->like('topik', $keyword)
                    ->orLike('notulis', $keyword)
                    ->orLike('tanggal', $keyword)
                    ->findAll();

        return $this->response->setJSON($data);
    }

        public function delete()
    {
        $json = $this->request->getJSON();
        $id = $json->id;

        $model = new DiscussionModel();
        
        if ($model->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data']);
        }
    }

}
