<?php 
   /* Template Name: Softwares template */
   if (strlen($_POST['list'])) {
     session_destroy();
     $_SESSION = array();
   }
   get_header(); ?>
<div class="content blog">
   <div class="clearfix">
      <style type="text/css">
         #main{padding-top: 0px!important;background: #fff!important;}
         h2{margin: 0px!important;}
      </style>
      <?php 
         $domain_name = $_SERVER['SERVER_NAME'];
         $Path=$_SERVER['REQUEST_URI'];
         
           //Output curent domain without http
         $str = 'http://'.$protocol.$domain_name.$Path;
         
          // echo get_site_url();  
         // $str = "http://conversion-hub.com/projects/on-going/ch-revamp/blog/direct-marketing/";
         $var1 =  (explode("/",$str));
         /*     echo "<pre>";
         print_r($var1);
         echo "</pre>";*/
         ?>
      <?php 
         if (empty($var1[4]) || $var1[4]=="page" ):  ?>
      <?php else: if(function_exists(simple_breadcrumb)) {simple_breadcrumb();} endif; ?>
        <?php if(isset($_SESSION['grid'])):
          include('category-software-template-grid-sess.php');
          else:?>
      <div class="software-select with_sidebar_rating width-75-percent main-side clearfix pad-t-b-6-r-15">
         <div class='post-filters'>
         <div class="filter">
            <form action="" method="GET">
               <span class="sel">Sort by:</span>
               <select name="orderby" onchange="this.form.submit()">
                  <?php $modifier=array();
                     $modifier['meta_value_num'] = $_GET['orderby'];
                     $modifier['rehub_offer_product_price'] = $_GET['orderby'];
                     $modifier['ASC'] = $_GET['orderby'];
                     
                     // echo $_GET['orderby'][1];
                     
                     if ($_GET['orderby']==='price-low-to-high'):
                        $arrayName = array('meta_value_num','rehub_offer_product_price','ASC');
                      // echo $arrayName[2];
                      elseif($_GET['orderby']==='price-high-to-low'):
                        $arrayName = array('meta_value_num','rehub_offer_product_price','DESC');
                      // echo $arrayName[2];
                         elseif($_GET['orderby']==='avg-customer-review'):
                        $arrayName = array('meta_value_num','rehub_review_overall_score','DESC');
                      // echo $arrayName[2];
                        elseif($_GET['orderby']==='most-reviews'):
                        $arrayName = array('comment_count','','DESC');
                     endif;
                     ?>
                  <option <?php if($_GET['orderby']==='price-low-to-high'):?>selected="true"<?php endif;?>value='price-low-to-high'>Price: Low to High</option>
                  <option  <?php if($_GET['orderby']==='price-high-to-low'){ ?>selected="true"<?php } ?>value='price-high-to-low'>Price: High to Low</option>
                  <option  <?php if($_GET['orderby']==='avg-customer-review'):?>selected="true"<?php endif;?>value='avg-customer-review'>Avg: Customer Review</option>
                  <option  <?php if($_GET['orderby']==='most-reviews'):?>selected="true"<?php endif;?>value='most-reviews'>Most Reviews</option>
               </select>
               <!-- <input type="submit" value="Submit"> -->
            </form>
            </div>
            <div class="filter">
            <span class="sel">Category:</span><?php wp_dropdown_categories('show_option_none=Select category&child_of=243'); ?>
            <script type="text/javascript">
               var dropdown = document.getElementById("cat");
               function onCatChange() {
               if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
               location.href = "<?php echo get_option('home');
                  ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
               }
               }
               dropdown.onchange = onCatChange;
            </script>
         </div>
         </div>
            <?php// print_r($_SESSION);?>
            <?php //print_r($_POST);?>

         <div class="types">
         <form action="http://usabilitytesting.sg/software/grid/" method="POST">
         <button style="color:#0395f3;" name="style" value="list"><i class="fa fa-th-list"></i></button><button  type="submit" name="grid" value="grid"><i class="fa fa-th-large"></i></button></form>
         </div>
         <?php// echo $arrayName[2];?>
         <?php //echo $_GET['orderby'];?>
         <h2 style="margin-top:20px!important;margin-bottom: 20px!important;float:left;width: 100%;"class="blog-title">  </h2>
            <?php
               // if ($var[6]=="blog"): 
                $term = get_queried_object();
               
                $children = get_terms( $term->taxonomy, array(
                'parent'    => $term->term_id,
                'hide_empty' => false
                ) );
               
                $cat = get_query_var('cat');
                $yourcat = get_category ($cat);
               
               if (empty($var1[4]) || $var1[4]=="page"):
                  $var2 = $var1[3];
               elseif($children):
                  $var2 = $yourcat->slug;
               
               else:
                   $var2=$var1[4];
               endif;
               ?>
 <!--        <div style="float:left;width: 100%;">
       <div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div> 
       <p>This is a paragraph.</p>
       <button>Get External Content</button>
       </div> -->
         <?php 

         // if (isset($_GET['style']==='list')) {
            
         // }
         
?>

<?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            $args = array( 'post_type' => 'post','category_name' => $var2,'paged' => $paged, 
              'orderby' => $arrayName[0] ,
                            'meta_key'  => $arrayName[1] ,'order' => $arrayName[2]);
            $wp_query = new WP_Query($args);
            if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
         <div class="software row">
            <?php 
               if ( strlen( $img = get_the_post_thumbnail( get_the_ID(), array( 150, 150 ) ) ) ) {?>
            <div class="width-23-percent-blog">
               <div style="margin: 10px 0;"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-responsive','style' => 'width:100%;max-width:180px;max-height:110px;border:1px solid #ebebeb;' ) ); ?></div>
            </div>
            <?php } else {  ?>
            <div class="width-23-percent-blog">
               <div style="margin:10px 10px 10px 0;max-width:180px;height: 110px;background:#000; "></div>
            </div>
            <?php }
               ?>
            <div style="padding:5px 0;"class="width-73-percent-blog">
               <div style="width:65%;float: left;">
                  <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
               </div>
               <div class="right-meta"style="padding:5px 0;font-size:12px!important;width:35%;float: left;">
                  <?php 
                     $custom = get_post_custom();
                       echo '<div>Price from '.'<span style="color:red;font-weight:bold;">'.$custom['rehub_offer_product_price'][0].'</span>'.'</div>';
                       echo '<div>'.rehub_get_user_results().'</div>';
                      // echo '<div>'.'<span style="color:blue;">'.$custom['rehub_views'][0].'</span>'.'</div>';?>
                  <a title="See lists of reviews"style="color:#00709a;" href="<?php the_permalink().'#respond';?>"><?php comments_number( 'no reviews', '1', '% ' ); ?>
                  </a>
                  <?php
                     // echo rehub_get_user_rate('user');
                              // echo $custom['rehub_views'][0];
                     // print_r($custom['rehub_views']);
                     ?>
               </div>
               <?php//  echo wpb_get_post_views(get_the_ID());
                  ?>
               <p style="float: left;"><?php   echo get_excerpt(300);?></p>
               <?php 
                  /*foreach($custom as $key => $value) {
                       echo $key.': '.$value[0].'<br />';
                  }*/
                  ?>
            </div>
            <div class="col-sm-12">
               <div class="border-bottom-gray">
               </div>
            </div>
         </div>
         <?php  endwhile; endif; ?>
         <?php// print_r(average_rating()); ?>
         <div class="col-sm-12">
            <?php // Get the pagination
               rehub_pagination();
               ?>
         </div>
         <?php wp_reset_query();?>
      </div>
       <?php     endif;
        ?>

      <aside class="width-22-percent sidebar" style="border: 1px solid rgb(235, 235, 235);">
         <div>
            <?php// echo do_shortcode('[widget id="categories-4"]');?>
            <div id="categories-4" class="widget">
               <h2 class="widgettitle">Labels</h2>
               <ul> <?php wp_list_categories('child_of=243&title_li=');?></ul>
            </div>
         </div>
      </aside>
   </div>
</div>
<!-- Main Side -->
<!-- /CONTENT -->     
<!-- FOOTER -->

<?php get_footer(); ?>