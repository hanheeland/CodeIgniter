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

    public function board_data($id)
    {
        if (empty($id)) {
            return false;
        }
        $sql = "SELECT * 
                  FROM board 
                 WHERE id = $id
                 LIMIT 1
               ";
        $res = $this->db->query($sql);
        if ($res !== false) {
            $data['view'] = $res->getRow();
            return $data;
        }
        return false;
    }

    public function make_query($datas = array())
    {
        if (!is_array($datas) || empty($datas)) {
            return false;
        }
        $result = array();
        foreach ($datas AS $k => $v) {
            if ($k == 'id') { continue; }
            $result[] .= "{$k} = '{$v}'";
        }
        $result[] .= "DATE = NOW()";
        return implode(",",$result);
    }

    public function list()
    {
        /*
        // 쿼리빌더 예시
        $data['lists'] = $this->boardModel->orderBy('id', 'DESC')->findAll();
        */
        $sql = "SELECT * FROM board ORDER BY id DESC";
        $res = $this->db->query($sql);
        $data['lists'] = $res->getResult();
        return render('board_list', $data);
    }

    public function write()
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
        $make_query = $this->make_query($_POST);
        $sql = "INSERT INTO 
                  board SET
                       user = 'hanhee',
                       {$make_query}
               ";
        $res = $this->db->query($sql);
        if ($res !== false) {
            log_message("info", $sql);
        }
        return $this->response->redirect('/board');
    }


    public function modify($id)
    {
        if (empty($id)) {
            return false;
        }
        $data = $this->board_data($id);
        return render('board_write', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $make_query = $this->make_query($_POST);
        $sql = "UPDATE
             board SET
                 {$make_query}
                 WHERE id = $id
               ";
        $res = $this->db->query($sql);
        if ($res !== false) {
            log_message("info", $sql);
        }
        return $this->response->redirect('/boardView/'.$id);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return false;
        }
        $sql = "DELETE FROM board where id = $id";
        $res = $this->db->query($sql);
        if ($res !== false) {
            log_message("info", $sql);
        }
        return $this->response->redirect('/board');
    }

    public function view($id)
    {
        /*
        // 쿼리빌더 예시
        $boardModel = new BoardModel();
        $board_result = $boardModel->where('id', $id)->findAll();
        $data['views'] = $board_result;
        */
        if (empty($id)) {
            return false;
        }
        $data = $this->board_data($id);
        return render('board_view', $data);
    }
}
