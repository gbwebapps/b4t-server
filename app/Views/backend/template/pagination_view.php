<?php $numofpages = ceil($data['pagination']['totalRows'] / $data['pagination']['limit']); ?>

<div class="row">
    <div class="col-md-4">
        <?php $left = ($data['pagination']['totalRows'] == 0) ? '' : lang('backend/global.pagination.infoLeft', [$data['pagination']['page'], $numofpages]); ?>
        <div class="pagination_left"><?= $left ?></div>
    </div>
    <div class="col-md-4">
        <ul class="pagination pagination-sm justify-content-center">

        <?php if ($data['pagination']['totalRows'] > $data['pagination']['limit']): ?>
            <?php if($data['pagination']['page'] == 1): ?>

                <li class="page-item"></li>

            <?php else: ?>
                <?php $pageprev = $data['pagination']['page'] - 1; ?>

                <li class="page-item"><a class="page-link" href="#" data-page="1"><?= lang('backend/global.pagination.linkFirst') ?></a></li>
                <li class="page-item"><a class="page-link" href="#" data-page="<?= $pageprev ?>"><?= lang('backend/global.pagination.linkPrevious') ?></a></li>

            <?php endif; ?>
            <?php $range = 3; ?>
            <?php if ($range == '' || $range == 0): ?>
                <?php $range = 7; ?>
            <?php endif; ?>
            <?php $lrange = max(1, $data['pagination']['page'] - (($range - 1) / 2)); ?>
            <?php $rrange = min($numofpages, $data['pagination']['page'] + (($range - 1) / 2)); ?>
            <?php if (($rrange - $lrange) < ($range - 1)): ?>
                <?php if ($lrange == 1): ?>
                    <?php $rrange = min($lrange + ($range - 1), $numofpages); ?>
                <?php else: ?>
                    <?php $lrange = max($rrange - ($range - 1), 0); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($lrange > 1): ?>

                <li class="page-item"><span class="page-link">...</span></li>

            <?php endif; ?>
            <?php for($i = 1; $i <= $numofpages; $i++): ?>
                <?php if ($i == $data['pagination']['page']): ?>

                    <li class="page-item active"><span class="page-link"><?= $i ?></span></li>

                <?php else: ?>
                    <?php if ($lrange <= $i and $i <= $rrange): ?>

                        <li class="page-item"><a class="page-link" href="#" data-page="<?= $i ?>"><?= $i ?></a></li>

                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($rrange < $numofpages): ?>

                <li class="page-item"><span class="page-link">...</span></li>

            <?php endif; ?>
            <?php if(($data['pagination']['totalRows'] - ($data['pagination']['limit'] * $data['pagination']['page'])) > 0): ?>
                <?php $pagenext = $data['pagination']['page'] + 1; ?>

                <li class="page-item"><a class="page-link" href="#" data-page="<?= $pagenext ?>"><?= lang('backend/global.pagination.linkNext') ?></a></li>
                <li class="page-item"><a class="page-link" href="#" data-page="<?= $numofpages ?>"><?= lang('backend/global.pagination.linkLast') ?></a></li>

            <?php else: ?>

                <li></li>

            <?php endif; ?>
        <?php else: ?>
            <?php if($data['pagination']['totalRows'] == 0): ?>

                <li></li>

            <?php else: ?>

                <li class="page-item"><span class="page-link">1</span></li>

            <?php endif; ?>
        <?php endif; ?>

        </ul>
    </div>
    <div class="col-md-4">
        <?php $result_start = ($data['pagination']['page'] - 1) * $data['pagination']['limit'] + 1;
        if ($result_start == 0) $result_start = 1;
        $result_end = $result_start + $data['pagination']['limit'] - 1;
        if ($result_end < $data['pagination']['limit']):
            $result_end = $data['pagination']['limit'];  
        elseif ($result_end > $data['pagination']['totalRows']):
            $result_end = $data['pagination']['totalRows'];
        endif;
        if ($result_end > $data['pagination']['totalRows']):
            $result_end = $data['pagination']['totalRows'];
        endif;
        $right = ($data['pagination']['totalRows'] == 0) ? '' : lang('backend/global.pagination.infoRight', [$result_start, $result_end, $data['pagination']['totalRows']]); ?>
        <div class="pagination_right"><?= $right ?></div>
    </div>
</div>