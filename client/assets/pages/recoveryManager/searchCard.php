<div class="block-header">
    <h2>View Card</h2>
</div>


<!-- CPU Usage -->
<div class="row clearfix">
 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
     <div class="card">
         <div class="body">
           <form id="cardRegisterForm">
             <div class="row">

                 <div class="col-sm-6 col-sm-offset-3">
                     <div class="form-group">

                         <label for="CardNumber">Card Number</label>
                         <div class="form-line">
                         <input type="text"  class="form-control" autocomplete="off" id="CardNumber" name="CardNumber" placeholder="Card Number">
                         </div>
                     </div>

                     <div class="form-group">

                       <button type="button" data-color="purple" class="btn btn-success waves-effect btn-block" id="ViewButton">view</button>

                     </div>
                 </div>
             </div>
           </form>

         </div>
     </div>
 </div>

 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

         <div class="body">
        <h5>Recent Searches</h5>
        <div class="col-sm-3 text-left">
            <h5 id ="recentSearches"></h5>
        </div>

         </div>
 </div>
</div>
<!-- #END# CPU Usage -->


<div id="viewCardLoadDiv"></div>

<!--full card view php include-->
<?php include('viewCard.php') ?>
<!--end of full card view include -->






<script>


// A1607/94

var validator =  $("#cardRegisterForm").validate({
    rules: {

        CardNumber: {
             //turn off auto validate whilst typing
            required: true,
            remote: {
                url: '../../../application/controllers/DBfunctions/remoteApi.php',
                type: 'POST',
                data:{
                    functionName:'cardIdValidationWithOutRef'
                }
            }
        }
    }

});
    $(document).ready(function() {
        var cardRegisterForm     =  $('#cardRegisterForm');
        var cardNumber           = $('#CardNumber');
        var recentSearche           = $('#recentSearches');

        var fullCardModel = $('#fullCardModel');
        var branch = $('#Branch');

        var validationPass = false;


        // this is for enter press , this call on click event
        cardRegisterForm.keypress(function (e) {
            var key = e.which;
            if(key == 13)  // the enter key code
            {
                e.preventDefault();
                e.stopPropagation();
                $('#ViewButton').click();
                return false;
            }
        });

        $('#ViewButton').click(function() {
                  cardId = cardNumber.val();
                  validationPass = cardRegisterForm.valid();
                  if(validationPass){
                    cardCreator(cardId);
                  }else{
                    // alert("Invalid Card Id");
                    showBasicMessage("Invalid Card Id");
                  }

        });

        $('#fullCardModel').on('hide.bs.modal', function (e) {
          cardNumber.val('');
          cardNumber.focus();
          recentSearche.append(cardId +"</br>");
        })
    });


</script>


<script>
$.AdminBSB.input = {
    activate: function () {
        //On focus event
        $('.form-control').focus(function () {
            $(this).parent().addClass('focused');
        });

        //On focusout event
        $('.form-control').focusout(function () {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
            }
            else {
                $this.parents('.form-line').removeClass('focused');
            }
        });

        //On label click
        $('body').on('click', '.form-float .form-line .form-label', function () {
            $(this).parent().find('input').focus();
        });

        //Not blank form
        $('.form-control').each(function () {
            if ($(this).val() !== '') {
                $(this).parents('.form-line').addClass('focused');
            }
        });
    }
}

$.AdminBSB.input.activate();
</script>

<script>
function showBasicMessage(msg) {
    swal(msg);
}
</script>
