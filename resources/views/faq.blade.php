@extends('layouts.site-layout')


  @section('body')
  <div id="custom-banner" class="custom-banner custom-faq">
        <div class="container">
            <div class="col-sm-12">
                <div>
                <h1 class="text-center">Frequently Asked Questions</h1>
              </div>
            </div>
        </div>
    </div>

  <div class="custom-faq-accordion">

    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="heading faq-title text-center"><?php echo $faqs['title'];?></h2>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			      <?php 
			  if(count($faqs['question'])>0)
			  for($i=0;$i<count($faqs['question']);$i++){?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading<?php echo $i+1;?>">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i+1;?>" aria-expanded="true" aria-controls="collapseOne">
                                <?php echo $faqs['question'][$i]['question'] ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $i+1;?>" class="panel-collapse collapse <?php echo $i==0 ?'in':''?>" role="tabpanel" aria-labelledby="heading<?php echo $i+1;?>">
                        <div class="panel-body">
                             <?php echo $faqs['question'][$i]['answer'] ?>
                        </div>
                    </div>
                </div>
			<?php } else{?>
			<div class="text-center alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> No-Question found! </div>
			<?php }?>
			
			<!--<div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Section-2
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et facilisis mi. Nunc vitae pretium est, aliquet sagittis enim. Duis fringilla ipsum at velit gravida, ac luctus lorem euismod. Vivamus placerat dolor mi, vel feugiat dui egestas a. Fusce congue. </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Section-3
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et facilisis mi. Nunc vitae pretium est, aliquet sagittis enim. Duis fringilla ipsum at velit gravida, ac luctus lorem euismod. Vivamus placerat dolor mi, vel feugiat dui egestas a. Fusce congue. </p>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>


  

      <!-- <div class="container">

      

      <div id="accordion" role="tablist">
      <?php 
      if(count($faqs['question'])>0)
      for($i=0;$i<count($faqs['question']);$i++){?>
        <div class="card">
          <div class="card-header" role="tab" id="heading<?php echo $i+1;?>">
            <h5 class="mb-0">
              <a data-toggle="collapse" href="#collapse<?php echo $i+1;?>" aria-expanded="<?php echo $i==0 ? 'true':'false'?>" aria-controls="collapse<?php echo $i+1;?>">
                <?php echo $faqs['question'][$i]['question'] ?>
              </a>
            </h5>
          </div>

          <div id="collapse<?php echo $i+1;?>" class="collapse <?php echo $i==0 ?'show':''?>" role="tabpanel" aria-labelledby="heading<?php echo $i+1;?>" data-parent="#accordion">
            <div class="card-body">
              <?php echo $faqs['question'][$i]['answer'] ?>
            </div>
          </div>
        </div>
      <?php } else{?>
      <div class="text-center alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> No-Question found! </div>
      <?php }?>
      </div>

  </div> -->
  </div>
  <div class="custom-call-us">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p>Have a question? Call us at <span><strong>1-877-777-0450</strong></span></p>
            </div>
        </div>
    </div>
  </div>

  @endsection

@section('script')

<!-- <script type="text/javascript">
  $(documemt).ready(function()){

    $('.firstrow').

  });
</script>
 -->
@endsection