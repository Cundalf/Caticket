<? foreach($scripts as $script): ?> 
    <script type="text/javascript" src="<?= base_url("assets/js/$script.js?v=" . VERSION) ?>"></script>
<? endforeach; ?>