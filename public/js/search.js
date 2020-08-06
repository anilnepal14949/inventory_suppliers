var $timer;
        $(document).ready(function(){
            var $search = $('#search_student');
            $search.keyup(function() {
                var $val = $(this).val();
                $timer = setTimeout(function(){
                            searchUsers($val,1)
                        },500);
            });

            $search.focus(function(){
                var $val = $(this).val();
                $timer = setTimeout(function(){
                    searchUsers($val,1)
                },100);
            });

            $search.click(function(){
                var $val = $(this).val();
                $timer = setTimeout(function(){
                    searchUsers($val,1)
                },100);
            });

            $search.keydown(function() {
                clearTimeout($timer);
            });

            $("body").click(function(){
                $('.pro_under_box').slideUp('slow');
            });
        });
        function searchUsers($val, $selector) {
            var $this = $("#search_student");
            var $url = $('#homePath').val() + '/ajax-request/dashboard/users';
            $.ajax({
                url: $url,
                dataType: 'html',
                data: 'input=' + $val + '&selector=' + $selector,
                type: 'GET',
                cache: false,
                success: function (rval) {
                    $this.after("<div class='pro_under_box'></div>");
                    var $underbox = $(".pro_under_box");
                    var left = $this.position().left;
                    var top = $this.position().top;
                    top += $this.outerHeight();
                    $underbox.hide();
                    $underbox.css("top", top);
                    $underbox.css("left", left);
                    $underbox.css("width", $this.outerWidth());
                    $underbox.html(rval);
                    $underbox.slideDown("slow");
                }
            });
        }