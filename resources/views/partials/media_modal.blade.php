<div id="modal" class="modal">
        <div class="modal-dialog animated">
            <div class="modal-content">
                
                    <div class="modal-header">
                        <h4><i class="voyager-images"></i> {{ __('voyager.generic.media') }}</h4>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" class="file-path" />
                        @include('vendor.voyager.media.index_modal')
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" onclick="modal.close('cancel');">Cancel</button>
                        <button class="btn btn-success" type="button" onclick="modal.close('selected');">Select</button>
                    </div>
                
            </div>
        </div>
</div>


<script type="text/javascript">
        window.onload = function() {
            var targetInput = null;
            var modal = new RModal(document.getElementById('modal'), {
                //content: 'Abracadabra'
                beforeOpen: function(next) {
                    console.log('beforeOpen');
                    next();
                }
                , afterOpen: function() {
                    console.log('opened');
                }

                , beforeClose: function(next) {
                    console.log('beforeClose');
                    console.log($(this));
                    next();
                }
                , afterClose: function(action) {
                   
                    if (action == 'selected')
                    {
                        var filePath = $('.file-path');
                        var strArray = filePath.val().split("storage/");
                        var fileType = filePath.attr('file-type');
                        
                        $(targetInput).val(strArray[1]);
                        var htmlDislpay = '';
                        var buttonRemove = '<a href="#">Remove<a>'; 
                        if (fileType == 'picture'){
                           
                            htmlDislpay = '<img class="img-responsive kv-img-add" src="'+ filePath.val() +'"/>';
                            
                        }

                        if ($('.kv-img-add').length)
                        {
                            $('.kv-img-add').attr('src',filePath.val());
                        }
                        else
                        {
                            //$(targetInput).before(buttonRemove);
                            $(targetInput).after(htmlDislpay);
                            

                        }
                        //html(htmlDislpay);

                        //$(targetInput).after(htmlDislpay);
                    }
                }
                // , bodyClass: 'modal-open'
                // , dialogClass: 'modal-dialog'
                // , dialogOpenClass: 'animated fadeIn'
                // , dialogCloseClass: 'animated fadeOut'

                // , focus: true
                // , focusElements: ['input.form-control', 'textarea', 'button.btn-primary']

                // , escapeClose: true
            });

            document.addEventListener('keydown', function(ev) {
                modal.keydown(ev);
            }, false);

            $('.kravanh-media-modal').click(function(ev) {
                ev.preventDefault();
                targetInput = $(this).attr('target-input');
                
                modal.open();
            });

            window.modal = modal;
        }
    </script>