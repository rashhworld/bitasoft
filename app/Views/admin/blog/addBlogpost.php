<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header fw-bold">
                Add New Blogpost
            </div>
            <div class="card-body">
                <form class="row g-4 addBlogpost" autocomplete="off">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="btitle" placeholder="Enter title of the blog">
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control advTextarea" name="bdesc"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="bimg" class="form-label">Choose blog primary image</label>
                        <input type="file" class="form-control" name="bimg" id="bimg">
                    </div>
                    <div class="col-md-4">
                        <label for="bstatus" class="form-label">Choose blog status</label>
                        <select class="form-select" name="bstatus" id="bstatus">
                            <option value="" selected disabled hidden>Choose Here</option>
                            <option value="1">Publish Now</option>
                            <option value="0">Save as Draft</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label invisible">.</label>
                        <button class="btn btn-success w-100" onclick="addBlogpost('.addBlogpost')">Review and Submit Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>