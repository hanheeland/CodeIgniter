<h3 class="pb-4 mb-4 fst-italic border-bottom" style="text-align:center;">
    - 게시판 보기 -
</h3>
<article class="blog-post">
    <h2 class="blog-post-title"><?=$view->title?></h2>
    <p class="blog-post-meta"><?=$view->date?><a href="/board"><?=$view->user?></a></p>
    <hr>
        <p><?=$view->content?></p>
    </hr>
    <a href="/modify/<?=$view->id;?>"><button type="button" class="btn btn-primary">수정</button><a>
    <a href="/delete/<?=$view->id;?>"><button type="button" class="btn btn-warning">삭제</button><a>
    <a href="/board"><button type="button" class="btn btn-primary">목록</button><a>
</article>