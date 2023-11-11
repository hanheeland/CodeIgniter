<div class="col-md-8" style="margin:auto;padding:20px;">
  <div class="wrap">
  <table class="table">
        <thead>
            <tr>
            <th scope="col">번호</th>
            <th scope="col">글쓴이</th>
            <th scope="col">제목</th>
            <th scope="col">등록일</th>
            </tr>
        </thead>
        <tbody id="board_list">
            <?php foreach($lists as $list) { ?>
                <tr>
                    <th scope="row"><?=$list->id?></th>
                    <td><?=$list->user?></td>
                    <td><a href="/boardView/<?=$list->id?>"><?=$list->title?></a></td>
                    <td><?=$list->date?></td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
        <p style="text-align:right;">
            <a href="/boardWrite"><button type="button" class="btn btn-primary">등록</button><a>
        </p>
  </div>
  </div>
