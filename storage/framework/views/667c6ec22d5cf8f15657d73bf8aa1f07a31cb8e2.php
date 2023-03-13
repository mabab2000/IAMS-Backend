

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Add a New Post <a href="<?php echo e(route('posts.index')); ?>" class="label label-primary pull-right">Back</a>
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('posts.insert')); ?>" method="POST" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Content</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="content" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="Add Post" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\IAMS\IAMS\resources\views//posts/add.blade.php ENDPATH**/ ?>