<?php require_once _ROOTPATH_.'\templates\header.php';
/*@var $course \App\Entity\Course*/
 ?>

<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="uploads/courses/<?= $course->getImage(); ?>" class="d-block mx-lg-auto" alt="photo stade" width="400" >
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=$course->getName();?></h1>
        <p class="lead"><?=$course->getDescription();?></p>

        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Primary</button>
          <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
        </div>
      </div>
    </div>
  </div>


<?php require_once _ROOTPATH_.'\templates\footer.php'; ?>