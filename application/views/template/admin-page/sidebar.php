<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="width: 15rem;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Main Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="flex-shrink-0 bg-white">
            <ul class="list-unstyled ps-0">
                <li class="mb-1f">
                    <a class="text-black text-decoration-none align-items-center rounded">
                        <i class="fa-solid fa-gauge fa-fw me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="mb-1f">
                    <a class="text-black text-decoration-none dropdown-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                        <i class="fa-solid fa-users fa-fw me-2"></i>
                        User
                    </a>
                    <div class="collapse" id="home-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class="">
                                <a href="#" class="link-dark rounded">
                                    <i class="fa-solid fa-chalkboard-user fa-fw me-2"></i>
                                    Overview
                                </a>
                            </li>
                            <li class="">
                                <a href="#" class="link-dark rounded">
                                    <i class="fa-solid fa-user-graduate fa-fw me-2"></i>
                                    Updates
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1f">
                    <a class="text-black text-decoration-none dropdown-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                        Dashboard
                    </a>
                    <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class=""><a href="#" class="link-dark rounded">Overview</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Weekly</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Monthly</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Annually</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1f">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                        Orders
                    </button>
                    <div class="collapse" id="orders-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class=""><a href="#" class="link-dark rounded">New</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Processed</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Shipped</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Returned</a></li>
                        </ul>
                    </div>
                </li>
                <li class="border-top my-3"></li>
                <li class="mb-1f">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                        Account
                    </button>
                    <div class="collapse" id="account-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li class=""><a href="#" class="link-dark rounded">New...</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Profile</a></li>
                            <li class=""><a href="#" class="link-dark rounded">Settings</a></li>
                            <li class=""><a href="<?= base_url('logout'); ?>" class="link-dark rounded">Sign out</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <a class="text-black text-decoration-none p-3 text-center logout" id="logout" type="button" id="tombolLogout">Signout</a>
</div>