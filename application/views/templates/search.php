<div class="row top-buffer">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <form action="<?php echo base_url()."library/search_book" ?>" method="GET">
            <div class="input-group stylish-input-group">
                <input value="<?php if($search!=""){ echo $search; } ?>" type="text" class="form-control" name='search'  placeholder="Search book title, author, genre, keywords." >
                <span class="input-group-addon">
                    <button name='submit' type="submit"><span class="glyphicon glyphicon-search"></span></button>  
                </span>
            </div>
        </form>
    </div>
    <div class="col-md-3 "></div>
</div>