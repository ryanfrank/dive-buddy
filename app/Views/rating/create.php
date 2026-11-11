<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container" style="max-width:600px; margin:0 auto;">
        <h1><?= lang('Rating.rate_partner') ?></h1>
        <p><?= lang('Rating.rate_for_dive', ['dive' => esc($dive['dive_date'])]) ?></p>

        <?php if (empty($partners)): ?>
            <div class="alert alert-info"><?= lang('Rating.no_partners') ?></div>
            <a href="/dives/<?= $dive['id'] ?>" class="btn btn-primary"><?= lang('Dive.back_to_dive') ?></a>
        <?php else: ?>
            <form action="/rating/store" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="dive_id" value="<?= $dive['id'] ?>">

                <div class="form-group">
                    <label><?= lang('Rating.select_partner') ?></label>
                    <select name="rated_user_id" required>
                        <option value=""><?= lang('Rating.select_partner') ?></option>
                        <?php foreach ($partners as $p): ?>
                            <option value="<?= $p['user_id'] ?>"><?= esc($p['user_name']) ?> (<?= esc($p['certification_level'] ?? '—') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><?= lang('Rating.your_rating') ?></label>
                    <div class="star-rating" style="display:inline-flex; gap:0.25rem;">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star empty" data-value="<?= $i ?>" style="cursor:pointer; font-size:1.5rem;">☆</span>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="rating" value="5">
                    <div class="field-hint"><?= lang('Rating.star_hint') ?></div>
                </div>

                <div class="form-group">
                    <label><?= lang('Rating.comment') ?></label>
                    <textarea name="comment" rows="3" placeholder="<?= lang('Rating.comment_placeholder') ?>"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block"><?= lang('Rating.submit_rating') ?></button>
            </form>
            <a href="/dives/<?= $dive['id'] ?>" class="btn btn-ghost btn-block" style="margin-top:0.75rem;"><?= lang('Dive.back_to_dive') ?></a>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
