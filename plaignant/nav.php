
<div class="section-content-right">
    <!-- header-dashboard -->
    <div class="header-dashboard">
        <div class="wrap">
            <div class="header-left">
                <a href="index.html">
                    <img class="" id="logo_header_mobile" alt="" src="../DALL·E-2025-03-16-16.53.47-A-simple-and-modern-text-based-logo-for-_PlaintOnline_.png"
                        data-light="../DALL·E-2025-03-16-16.53.47-A-simple-and-modern-text-based-logo-for-_PlaintOnline_.png"
                        data-dark="../DALL·E-2025-03-16-16.53.47-A-simple-and-modern-text-based-logo-for-_PlaintOnline_.png"
                        data-width="154px" data-height="52px" data-retina="images/logo/logo@2x.png" />
                </a>
                <div class="button-show-hide">
                    <i class="icon-menu-left"></i>
                </div>
                <form class="form-search flex-grow">
                    <fieldset class="name">
                        <input type="text" placeholder="Search here..." class="show-search" name="name"
                            tabindex="2" value="" aria-required="true" required="" />
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit">
                            <i class="icon-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="header-grid">
                <div class="header-item button-dark-light">
                    <i class="icon-moon"></i>
                </div>

                <div class="header-item button-zoom-maximize">
                    <div class="">
                        <i class="icon-maximize"></i>
                    </div>
                </div>

                <div class="popup-wrap user type-header">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="header-user wg-user">
                                <span class="image">
                                    <img src="images/avatar/user-1.png" alt="" />
                                </span>
                                <span class="flex flex-column">
                                    <span class="body-title mb-2">
                                        <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Utilisateur'; ?>
                                    </span>
                                    <span class="text-tiny">
                                        <?php echo isset($_SESSION['user_statut']) ? htmlspecialchars($_SESSION['user_statut']) : 'Statut inconnu'; ?>
                                    </span>
                                    <span class="text-tiny">
                                        <?php echo isset($_SESSION['user_type']) ? htmlspecialchars($_SESSION['user_type']) : 'Type inconnu'; ?>
                                    </span>
                                </span>
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end has-content"
                            aria-labelledby="dropdownMenuButton3">
                            <li>
                                <a href="setting.php" class="user-item">
                                    <div class="icon">
                                        <i class="icon-settings"></i>
                                    </div>
                                    <div class="body-title-2">Mon compte</div>
                                </a>
                            </li>
                            <li>
                                <a href="logout.php" class="user-item">
                                    <div class="icon">
                                        <i class="icon-log-out"></i>
                                    </div>
                                    <div class="body-title-2">Déconnexion</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /header-dashboard -->