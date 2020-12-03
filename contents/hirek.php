<?php
$sql = "SELECT n.id, n.title, n.body, n.created, u.username AS creator FROM news AS n "
        ."LEFT JOIN users AS u ON (n.creator = u.id) ORDER BY created DESC";
$connection = Database::getConnection();
$stmt = $connection->query($sql);
?>
<div class="accordion" id="accordionExample">
    <?php while ($news = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="card">
        <div class="card-header" id="heading_<?php echo $news['id']; ?>">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo $news['id']; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $news['id']; ?>">
                    <dl class="row">
                        <dt class="col-8"><?php echo $news['title']; ?></dt>
                        <dd class="col-4 text-right"><?php echo $news['creator'] . ', ' . $news['created']; ?> </dd>
                    </dl>
                </button>
            </h2>
        </div>
        <div id="collapse_<?php echo $news['id']; ?>" class="collapse" aria-labelledby="heading_<?php echo $news['id']; ?>" data-parent="#accordionExample">
            <div class="card-body">
                <?php echo $news['body']; ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
