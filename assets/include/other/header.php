<!-- BYTE-STORE.DE API -->
<input hidden id="byte_api_hash" value="<?php echo $SESSION->getHash(); ?>">
<!-- BYTE-STORE.DE API -->

<ul id="account" class="dropdown-content">
    <li><a href="?page=account">Einstellungen</a></li>
    <li class="divider" style="background-color: var(--color_black_2);"></li>
    <?php if ($SESSION->isLogged()) { ?>
        <li><a href="?page=logout">Ausloggen</a></li>
    <?php } else { ?>
        <li><a href="?page=login">Anmelden</a></li>
    <?php } ?>
</ul>
<nav>
    <div class="nav-wrapper">
        <a href="?page=index" class="brand-logo">&nbsp;&nbsp;Byte-Store.DE</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <?php if ($SESSION->isAdmin()) { ?>
                <li><a href="?page=control">Control-Center</a></li>
            <?php } ?>
            <?php if ($SESSION->isLogged()) { ?>
                <li><a href="?page=server">Meine Produkte</a></li>
            <?php } ?>
            <li><a href="?page=status">Status</a></li>
            <li><a class="dropdown-login" data-target="account">Benutzer<i
                            class="material-icons right">arrow_drop_down</i></a>
            </li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <?php if ($SESSION->isLogged()) { ?>
        <li><a href="?page=server">Meine Produkte</a></li>
    <?php } ?>
    <li><a href="?page=status">Status</a></li>
    <li><a class="dropdown-login-m" data-target="account">Benutzer<i
                    class="material-icons right">arrow_drop_down</i></a></li>
</ul>