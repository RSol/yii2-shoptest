<?php if ($name): ?>
    <p>
        <strong>Акции:</strong> <?= implode(', ', $name) ?>
    </p>
<?php endif; ?>
<p>
    <strong>Итого:</strong> <?= $amount ?> у.е.
</p>