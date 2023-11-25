<?php
$action = "/writeSave";
if (isset($view->title)) {
    $action = "/updateSave";
    //$id = $view->id;
}
?>
<form method="post" action="<?=$action?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=isset($view->id) ? $view->id : ""?>">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">제목</label>
        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="제목을 입력하세요." value="<?=isset($view->title) ? $view->title : '';?>">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">내용</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"><?=isset($view->content) ? $view->content : '';?></textarea>
    </div>
    <br />
    <button type="submit" class="btn btn-primary">등록</button>
</form>