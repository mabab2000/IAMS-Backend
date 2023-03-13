


  
                    <h2>Posts List </h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="<?php echo e(route('posts.add')); ?>"> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                        <th width="25%">Title</th>
                        <th width="40%">Content</th>
                        <th width="15%">Created</th>
                        <th width="20%">Action</th>
                    </thead>
    
                    <!-- Table Body -->
                    
                    </tbody>
                </table>
            </div>
        </div>
   
 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\IAMS\IAMS\resources\views/welcome.blade.php ENDPATH**/ ?>