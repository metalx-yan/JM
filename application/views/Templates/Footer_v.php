<script src="<?= base_url('Assets/bootstrap-5/js/bootstrap.min.js') ?>"></script>

<script>
    // can't enter
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    // vue for active menu
    const vm = new Vue({
        el: '#nav_',
        data: {
            childActive: function (){
                var currentUrl = window.location.pathname.split('/')
                record_num = '';
                for ($i = 2; $i <= currentUrl.length - 2 ; $i++) {
                    record_num  += currentUrl[$i]+"/";
                }
                return record_num
            },
            parentActive: function (){
                var currentUrl = window.location.pathname.split('/')
                record_num = '';
                for ($i = 2; $i <= currentUrl.length - 3 ; $i++) {
                    record_num  += currentUrl[$i]+"/";
                }
                return record_num
            },
        },
    })
</script>



</body>

</html>