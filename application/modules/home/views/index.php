<?php include('./application/views/content/indonesian_date.php');?>
        <div class="row">
                    <div class="col-lg-12 paddingless">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden">
                          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                          
                          
                          <?php $i=1;?>
                          <?php foreach($slider AS $rwslide) :?>
                          <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i++ ;?>"></li>
                          <?php endforeach ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner custom-carousel" role="listbox">
                          <div class="item active">
                            <img src="<?php echo base_url() ;?>uploads/gallery/<?php echo $slider->slider_path.'/'.$slider->slider_img ;?>" alt="slider <?php echo $slider->slider_id ;?>" class="img-responsive">
                            <div class="carousel-caption">
                                <h3><?php echo $slider->slider_title ;?></h3>
                                <p><?php echo $slider->slider_caption ;?></p>
                            </div>
                          </div>
                            
                          <?php foreach($sliders AS $rwslide) :?>  
                          <div class="item">
                             <img src="<?php echo base_url() ;?>uploads/gallery/<?php echo $rwslide->slider_path.'/'.$rwslide->slider_img ;?>" alt="slider <?php echo $rwslide->slider_id ;?>" class="img-responsive">
                            <div class="carousel-caption">
                                <div class="layer-out">
                                    <h3><?php echo $rwslide->slider_title ;?></h3>
                                </div>
                                
                               <p><?php echo $rwslide->slider_caption ;?></p>
                            </div>
                          </div>
                          <?php endforeach;?>  
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>    
        </div>
        
        <div class="clearfix"></div>
                
                <div class="row">
                    <?php if($birthday){?>
                    <div class="col-lg-12 marquee">
                        
                        <?php foreach($birthday AS $key => $value) :?>
                            <?php $thisyear = new DateTime('today'); $jemaatyear = new DateTime($value[0]->dob); $age = $jemaatyear->diff($thisyear)->y?>
                            <?php echo 'Selamat Ulang Tahun Kepada: '.  $value[0]->f_name.' '.$value[0]->l_name .' Yang Ke - '.$age ;?> ,-
                            <?php endforeach ;?>
                          
                    </div>
                    <?php } ?>  
                </div>

        <div class="clearfix"></div>

        <div class="col-lg-3 paddingless news">
            <?php foreach ($leftnews as $parent => $ln){
            $name = $ln['name'];
            $cat_id = $ln['cat_id'];
            $limit = $ln['limit'];
            $bKiri = $this->model->getBerita($cat_id, $limit, '0', 'create_at', 'desc');
                    //
            ?>
            <h4><?php echo $name; ?></h4>
                <div class="border-red"></div>
                <div class="border-grey"></div>
                <?php foreach($bKiri AS $bKiri) { $imgs = $this->extract->extractImage($bKiri->id,$bKiri->desk); ?>
                <div class="news-item">
                    <img src="<?php echo $imgs; ?>" />
                    <div class="news-item-text">
                        <div class="news-item-text date"><?php echo indonesian_date($bKiri->create_at, "l, j F Y") ;?></div>
                        <div class="news-item-text caption"><?php echo anchor('home/berita/'.$bKiri->slug, $bKiri->title) ;?></div>
                    </div>
                </div>
                <?php } ?>
                <div class="clearfix"></div>
                        
            <?php } ?>
        </div>

        <div class="col-lg-6 main-news">
            <div class="searchbar">
                <?php echo form_open('home/search', array('role'=>'search')) ;?>    
                    <div class="input-group">    
                    <input type="text" class="form-control " placeholder="Search" name="srch-term" required/>
                    <div class="input-group-btn">
                        <button class="btn btn-danger" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                    </div>
                <?php echo form_close() ;?>
            </div>
            <img src="http://placehold.it/240x320"/>
            <div class="category">SBU</div>
            <div class="title-div">
                <h3><?php echo $sbu->judul ;?></h3>
                <div class="clearfix"></div>
                <div class="author"><?php echo indonesian_date($sbu->tanggal, "l, j F Y").' / '.$sbu->nats .' / SBU '.$sbu->kategori ;?></div>
            </div>
            <div class="headline">
            <p>
                <?php echo html_entity_decode($sbu->desk) ;?>
            </p>
            </div>
            <div class="related-news">
                <?php $relateds = $this->model->get_sbu_before($sbu->id);?>
                <?php foreach($relateds AS $related) :?>
                <div class="item">
                    <div class="title"><?php echo $related->judul ;?></div>
                    <div class="perikop"><?php echo $related->nats ;?></div>
                    <p><?php echo character_limiter($related->desk, 140) ;?><?php echo anchor('home/sbu/'.$related->id, 'baca selengkapnya');?></p>
                </div>
                <?php endforeach ?>
            </div>
        </div>   