<?php if ($name): ?>
    <p>
        Акции: <?= implode(', ', $name) ?>
    </p>
<?php endif; ?>
<p>
    Итого: <?= $amount ?> у.е.
</p>