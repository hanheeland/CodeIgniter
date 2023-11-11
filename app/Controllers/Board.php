<?php
namespace App\Controllers;
use App\Models\BoardModel;
use CodeIgniter\HTTP\Request;

class Board extends BaseController
{
    private $db;
    protected $boardModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->boardModel = new BoardModel();
    }

    public function board_data($id = null)
    {    
        $sql = "SELECT * 
                  FROM board 
                 WHERE id = $id
                 LIMIT 1
               ";
        $res = $this->db->query($sql);
        $data['view'] = $res->getRow();
        return $data;
    }


    public function list(): string
    {
        /*
        // 쿼리빌더 예시
        $data['lists'] = $this->boardModel->orderBy('id', 'DESC')->findAll();
        */        
        $this->db = db_connect();
        $sql = "SELECT * FROM board ORDER BY id DESC";
        $res = $this->db->query($sql);
        $data['lists'] = $res->getResult();
        return render('board_list', $data);
    }

    public function write(): string
    {
        return render('board_write');
    }

    public function save()
    {
        /* 
        // 쿼리빌더 예시
        $data = [
            'user' => 'hanhee'
          , 'title' => $this->request->getVar('title')
          , 'content' => $this->request->getVar('content')
          , 'date' => date("Y-m-d")
        ];
        $this->boardModel->save($data);
        */
        $title = $this->request->getVar('title');
        $content = $this->request->getVar('content');
        $sql = "INSERT INTO 
                  board SET
                       user = 'hanhee',
                      title = $title,
                    content = $content,
                       date = NOW()
               ";
        $res = $this->db->query($sql);
        if ($res !== false) {
            log_message("info", $sql);
        }
        return $this->response->redirect('/board');
    }


    public function modify($id = null)
    {
        $data = $this->board_data($id);
        return render('board_write', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $title = $this->request->getVar('title');
        $content = $this->request->getVar('content');
        $sql = " UPDATE
               board SET
                   title = $title,
                 content = $content,
                    date = NOW()
                WHERE id = $id
               ";
        $res = $this->db->query($sql);
        if ($res !== false) {
            log_message("info", $sql);
        }
        return $this->response->redirect('/boardView/'.$id);
    }

    public function delete($id = null)
    {
        $sql = "DELETE FROM board where id = $id";
        $res = $this->db->query($sql);
        return $this->response->redirect('/board');
    }

    public function view($id = null): string
    {
        /*
        // 쿼리빌더 예시
        $boardModel = new BoardModel();
        $board_result = $boardModel->where('id', $id)->findAll();
        $data['views'] = $board_result;
        */
        $data = $this->board_data($id);
        return render('board_view', $data);
    }
}
