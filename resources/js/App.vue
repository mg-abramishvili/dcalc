<template>
    <div class="wrapper">
        <Sidebar :class="{ collapsed: sidebar === false }" />
        <div class="main">
<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a @click="sidebar_toggle()" class="sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>


					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Поиск ..." aria-label="Поиск">
						<button class="btn" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
					</div>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a @click="bell_icon_toggle()" class="nav-icon dropdown-toggle" :class="{ show: bell_icon === true }" id="messagesDropdown">
								<div class="position-relative">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell align-middle me-2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" :class="{ show: bell_icon === true }" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										Новые уведомления
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Carl Jenkins">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Игорь Васильев</div>
												<div class="text-muted small mt-1">создал новое КП</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Carl Jenkins">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Игорь Васильев</div>
												<div class="text-muted small mt-1">создал новый расчет</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="https://appstack.bootlab.io/img/avatars/avatar.jpg" class="avatar img-fluid rounded-circle" alt="Carl Jenkins">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Петр Иванов</div>
												<div class="text-muted small mt-1">Иван Петров выполнил задачу</div>
												<div class="text-muted small mt-1">"Создай расчет киоска для РЖД"</div>
											</div>
										</div>
									</a>
								</div>
								<!--<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>-->
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings align-middle"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="https://appstack.bootlab.io/img/avatars/avatar.jpg" class="avatar img-fluid rounded-circle me-1" alt="Chris Wood"> <span class="text-dark">Петр Иванов</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user align-middle me-1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile</a>
								<a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart align-middle me-1"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pages-settings.html">Settings &amp; Privacy</a>
								<a class="dropdown-item" href="#">Help</a>
								<a class="dropdown-item" href="#">Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
            <main class="content">
                <div class="container-fluid p-0">
                    <router-view :key="$route.path" />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
    import Sidebar from './components/Sidebar'

    export default {
        data() {
            return {
				sidebar: true,
				bell_icon: false,
            }
        },
        created() {
        },
		methods: {
			sidebar_toggle() {
				if (this.sidebar === false) {
					this.sidebar = true
				} else {
					this.sidebar = false
				}
			},
			bell_icon_toggle() {
				if (this.bell_icon === false) {
					this.bell_icon = true
				} else {
					this.bell_icon = false
				}
			}
		},
        components: {
            Sidebar
        }
    }
</script>