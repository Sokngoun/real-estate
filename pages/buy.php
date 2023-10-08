<div class="untree_co-section">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6">
        <h2 class="text-secondary heading-2">Buy Properties</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
      </div>
    </div>
  </div>
</div>


<div class="untree_co-section bg-light">
  <div class="container">
    <div class="row">
      <?php

      $sql = "select * from tbl_property order by property_id desc";
      $result = mysqli_query($conn, $sql);

      if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {


      ?>
          <div class="col-md-6 col-lg-4">
            <div class="property-entry">
              <img src="img/<?= $row[8] !== '' ? $row[8]:'no-image.jpg'?>" alt="Image" class="img-fluid">
              <div class="property-specs">
                <strong class="price">$2,013,920</strong>
                <ul class="list-unstyled specs">
                  <li class="d-inline-flex align-items-center">
                    <span class="icon-wrap flaticon-bathtub"></span>
                    <strong>2</strong>
                  </li>
                  <li class="d-inline-flex align-items-center">
                    <span class="icon-wrap flaticon-bed"></span>
                    <strong>4</strong>
                  </li>
                  <li class="d-inline-flex align-items-center">
                    <span class="icon-wrap flaticon-house-size"></span>
                    <strong>120<sup>2</sup></strong>
                  </li>
                </ul>

                <div class="location d-flex justify-content-between align-items-center">
                  <div>
                    <span class="d-block caption">location: </span>
                    <h3><a href="#"><span>2 Zwar Place, Florey</span></a></h3>
                  </div>
                  <div class="more">
                    <a href="#">
                      <span class="icon-keyboard_backspace"></span>
                    </a>
                  </div>
                </div>

              </div>
            </div> <!-- /.property-entry -->
          </div> <!-- /.col-lg-4 -->
      <?php
        }
      } else {
        echo "No Data";
      }
      ?>
    </div> <!-- /.row -->
    <div class="row mt-5">
      <div class="col-12">
        <ul class="list-unstyled untree_co-pagination">
          <li><a href="#">1</a></li>
          <li><span>2</span></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
        </ul> <!-- /.list-unstyled -->
      </div> <!-- /.col-12 -->
    </div> <!-- /.row -->
  </div> <!-- /.container -->
</div>
<!-- /.untree_co-section -->


<div class="untree_co-section">
  <div class="container">
    <div class="row gutter-v3">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <a href="#" class="feature-v2 d-flex">
          <div class="icon-wrap">
            <span class="icon-support"></span>
          </div>
          <div class="text">
            <h3 class="heading">Ask our Customer Service</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </a> <!-- /.feature-v2 -->
      </div> <!-- /.col-lg-6 -->
      <div class="col-lg-6 mb-4 mb-lg-0">
        <a href="#" class="feature-v2 d-flex">
          <div class="icon-wrap">
            <span class="icon-chat_bubble_outline"></span>
          </div>
          <div class="text">
            <h3 class="heading">Visit our Blog</h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </a> <!-- /.feature-v2 -->
      </div> <!-- /.col-lg-6 -->
    </div> <!-- /.row -->
  </div> <!-- /.container -->
</div>