<template>
	<div>
		<div v-if="authenticated === false" id="auth_form" class="main d-flex justify-content-center w-100">
			<main class="content d-flex p-0">
				<div class="container d-flex flex-column">
					<div class="row h-100">
						<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
							<div class="d-table-cell align-middle">

								<div class="text-center mt-4 mb-4">
									<h1 class="h2">DreamApp CRM</h1>
								</div>

								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">
											<form @submit.prevent="handleLogin">
												<div v-if="login_error_message.length" class="alert alert-danger alert-dismissible" role="alert">
													<div class="alert-message">
														{{ login_error_message }}
													</div>
												</div>
												<div class="mb-3">
													<label class="form-label">E-mail</label>
													<input type="email" name="email" class="form-control form-control-lg" v-model="formData.email" placeholder="">
												</div>
												<div class="mb-3">
													<label class="form-label">Пароль</label>
													<input type="password" name="password" class="form-control form-control-lg" v-model="formData.password" placeholder="">
													<!--<small>
														<a href="#">Восстановить пароль</a>
													</small>-->
												</div>
												<!--<div>
													<div class="form-check align-items-center">
														<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked="">
														<label class="form-check-label text-small" for="customControlInline">Запомнить меня</label>
													</div>
												</div>-->
												<div class="text-center mt-3">
													<button type="submit" class="btn btn-lg btn-primary">Войти</button>
												</div>
											</form>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	
		<div v-else class="wrapper">
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
							<li class="nav-item">
								<router-link :to="{name: 'UserEdit', params: {id: user.id }}" class="nav-link d-sm-inline-block">
									<img src="/img/profile.png" class="avatar img-fluid rounded-circle me-1" alt="Chris Wood"> <span class="text-dark">{{ user.name }}</span>
								</router-link>
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
	</div>
</template>

<script>
    import Sidebar from './components/Sidebar'

    export default {
        data() {
            return {
				sidebar: true,
				bell_icon: false,

				formData: {
                    email: '',
                    password: ''
                },

				user: {},
				authenticated: false,
				login_error_message: '',

				counter_users: '',
				counter_projects: '',
				counter_clients: '',
				counter_partners: '',
				counter_elements_boxes: '',
            }
        },
        created() {
			this.checkMe()
        },
		methods: {
			handleLogin() {
                // send axios request to the login route
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/login', this.formData).then(response => {
						if(response.data === 'bad_login') {
							this.login_error_message = 'Неверный E-mail или пароль'
						} else {
							this.checkMe()
						}
                    })
                });
            },
			checkMe() {
				axios.post('/api/me').then(response => {
					this.user = response.data
					if(this.user.name && this.user.name.length) {
						this.authenticated = true
						this.counterUsers()
						this.counterProjects()
						this.counterClients()
						this.counterPartners()
						this.counterElementsBoxes()
					} else {
						this.authenticated = false
					}
				})
			},
			counterUsers() {
				axios.get('/api/counter_users').then(response => {
					this.counter_users = response.data
                });
			},
			counterProjects() {
				axios.get('/api/counter_projects').then(response => {
					this.counter_projects = response.data
                });
			},
			counterClients() {
				axios.get('/api/counter_clients').then(response => {
					this.counter_clients = response.data
                });
			},
			counterPartners() {
				axios.get('/api/counter_partners').then(response => {
					this.counter_partners = response.data
                });
			},
			counterElementsBoxes() {
				axios.get('/api/counter_elements_boxes').then(response => {
					this.counter_elements_boxes = response.data
                });
			},
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