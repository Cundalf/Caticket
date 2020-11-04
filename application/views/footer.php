        <footer>
            <script type="text/javascript" src="<?= base_url('vendor/components/jquery/jquery.min.js') ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/js/jquery.blockUI.min.js') ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/js/popper.min.js') ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/js/tooltip.min.js') ?>"></script>
            <script type="text/javascript" src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/sweetalert2/sweetalert2.min.js') ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/js/functions.js?v=' . VERSION) ?>"></script>
            <?= (isset($scripts) ? $scripts : "") ?>
        </footer>
        </body>
</html>