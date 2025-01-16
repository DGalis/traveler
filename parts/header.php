<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
            <?php
            // Získanie názvu aktuálnej stránky
            $currentPage = basename($_SERVER['PHP_SELF'], ".php");
            // Prispôsobenie názvu stránky (capitalize first letter)
            $pageTitle = ucfirst(str_replace("_"," ",$currentPage));  //ucfirst prvé písmeno veľké

            ?>
            <h3 class="display-4 text-white text-uppercase">
                <?php  echo $pageTitle;?>
           </h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">
                    <?php echo $pageTitle;?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->