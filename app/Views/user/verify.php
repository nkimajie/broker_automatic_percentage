<?= $this->extend('user/layouts/default'); ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title" id="basic-layout-colored-form-control">Account Verification</h4>

    </div>
    <div class="card-body">
        <div class="card-block">

            <div class="card-text">
                <p>Update your profile to enable us know you better.</p>
            </div>

            <div class="content-body"><!-- stats -->
                <div class="row">
                <div class="card-text">
                    <p class='pl-2'>Upload a valid ID card to verify your account e.g International Passport, Driver's License etc</p>
                </div>
                 <?php if ($user->account_status == 'pending'): ?>
                   <!-- dropzone -->
                   <!-- <div class="dropzone dz-clickable" id="myDrop">
                       <div class="dz-message needsclick">
                           <h2>Drag and Drop document here or click to upload</h2><br>
                           <span class="note needsclick">(Only <strong>valid</strong> document will be approved. Ensure you upload a clear copy)</span>
                       </div>
                   </div> -->
               <!-- drop zone ends  -->
               <form class="" action="<?= site_url() ?>users/verify_user" method="post">
                 <div class="mb-3">
                   <!-- flash messages -->
                   <?= view('flashMessages') ?>
                   <!-- flash messages end -->
                     <!-- <label for="formFile" class="form-label">Upload screenshot</label> -->
                     <input class="form-control" name="document" type="file" id="formFile">
                 </div>
                 <button type="submit" class="btn btn-primary" name="button">Submit</button>
               </form>


                </div>
                <?php else: ?>

                  <div class="illus" style="text-align: center;"><img src="<?= base_url('public/users/design/pending.svg') ?>" alt="pending" srcset="" style="width:30%;">
                  <p class="mt-1">Your account verification process is approved.</p>

                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- dropzone -->
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.2/dist/dropzone.min.js"></script>
<style>
    .dropzone{
        border-style: dotted !important;
        border-radius: 2em !important;
    }
</style>
<script>
//Dropzone Configuration
Dropzone.autoDiscover = false;
$(document).ready(function(){
    $("div#myDrop").dropzone({
        paramName: "document",
        acceptedFiles: ".jpeg,.jpg,.png,.pdf,.docx,.svg",
        maxFiles: 10,
        url: "<?= base_url('users/verify') ?>",
        success: function(file, response){
            var res = JSON.parse(response);
            // console.log(res);
            // console.log(res.status);
            if(res.status = 'success'){
                // window.location = res.redirect;
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Document successfully submitted. Your account is under review',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload();
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please retry process',
                    // footer: '<a href>Why do I have this issue?</a>'
                });
                location.reload();
            }
        }
    });
});
</script>

<?= $this->endSection() ?>
