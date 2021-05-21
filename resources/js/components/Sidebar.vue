<template>
    <nav class="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <router-link to="/calculations">
                    <img src="/img/logo.svg" alt="DreamApp">
                    <span>DreamApp CRM</span>
                </router-link>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-header">
					Расчеты и КП
				</li>
                <li class="sidebar-item">
                    <router-link to="/calculations" class="sidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <span class="align-middle">Расчеты</span>
                        <span class="badge badge-sidebar-primary">5</span>
                    </router-link>
                </li>
                <li class="sidebar-item">
                    <router-link to="/offers" class="sidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open align-middle"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                        <span class="align-middle">КП</span>
                        <span class="badge badge-sidebar-primary">5</span>
                    </router-link>
                </li>
                <li class="sidebar-item">
                    <router-link to="/elements" class="sidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list align-middle"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                        <span class="align-middle">Каталог</span>
                        <span class="badge badge-sidebar-primary">5</span>
                    </router-link>
                </li>
                <li class="sidebar-header">
					Задачи и пользователи
				</li>
                <li class="sidebar-item">
                    <router-link to="/users" class="sidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square align-middle"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span class="align-middle">Задачи</span>
                        <span class="badge badge-sidebar-primary">1</span>
                    </router-link>
                </li>
                <li class="sidebar-item">
                    <router-link to="/users" class="sidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span class="align-middle">Пользователи</span>
                        <span class="badge badge-sidebar-primary">1</span>
                    </router-link>
                </li>
                <li class="sidebar-header">
					Новости
				</li>
                <li class="sidebar-item">
                    <router-link to="/users" class="sidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square align-middle"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span class="align-middle">Новости</span>
                        <span class="badge badge-sidebar-primary">1</span>
                    </router-link>
                </li>
            </ul>

        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                moment: moment
            }
        },
        created() {
        },
        components: {
        }
    }
</script>