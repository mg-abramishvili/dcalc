import Home from './components/Home.vue';
import Users from './components/users/UsersAll.vue';
import UserCreate from './components/users/UserCreate.vue';
import UserEdit from './components/users/UserEdit.vue';

import Projects from './components/projects/ProjectsAll.vue';
import ProjectCreate from './components/projects/ProjectCreate.vue';
import ProjectItem from './components/projects/ProjectItem.vue';

import Clients from './components/clients/ClientsAll.vue';
import ClientCreate from './components/clients/ClientCreate.vue';

import Partners from './components/partners/PartnersAll.vue';
import PartnerCreate from './components/partners/PartnerCreate.vue';

import Elements from './components/elements/ElementsAll.vue';
import ElementsByCategory from './components/elements/ElementsByCategory.vue';
import ElementCreate from './components/elements/ElementCreate.vue';
import ElementEdit from './components/elements/ElementEdit.vue';
import ElementDelete from './components/elements/ElementDelete.vue';

import Boxes from './components/boxes/BoxesAll.vue';
import BoxCreate from './components/boxes/BoxCreate.vue';
import BoxEdit from './components/boxes/BoxEdit.vue';
import BoxDelete from './components/boxes/BoxDelete.vue';

import CategoryCreate from './components/categories/CategoryCreate.vue';
import CategoryEdit from './components/categories/CategoryEdit.vue';

import Calculations from './components/calculations/CalculationsAll.vue';
import CalculationCreate from './components/calculations/CalculationCreate.vue';
import CalculationEdit from './components/calculations/CalculationEdit.vue';
import CalculationItem from './components/calculations/CalculationItem.vue';
import Offers from './components/offers/OffersAll.vue';
import OfferCreate from './components/offers/OfferCreate.vue';
import OfferItem from './components/offers/OfferItem.vue';
import Tasks from './components/tasks/TasksAll.vue';
import TaskCreate from './components/tasks/TaskCreate.vue';
import Announcements from './components/announcements/AnnouncementsAll.vue';
import AnnouncementCreate from './components/announcements/AnnouncementCreate.vue';

export const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/users',
        name: 'Users',
        component: Users
    },
    {
        path: '/user/:id/edit',
        name: 'UserEdit',
        component: UserEdit
    },
    {
        path: '/users/create',
        name: 'UserCreate',
        component: UserCreate
    },
    {
        path: '/projects',
        name: 'Projects',
        component: Projects
    },
    {
        path: '/projects/create/:calculation_id/:offer_id',
        name: 'ProjectCreate',
        component: ProjectCreate
    },
    {
        path: '/project/:id',
        name: 'ProjectItem',
        component: ProjectItem
    },
    {
        path: '/clients',
        name: 'Clients',
        component: Clients
    },
    {
        path: '/clients/create',
        name: 'ClientCreate',
        component: ClientCreate
    },
    {
        path: '/partners',
        name: 'Partners',
        component: Partners
    },
    {
        path: '/partners/create',
        name: 'PartnerCreate',
        component: PartnerCreate
    },
    {
        path: '/elements',
        name: 'Elements',
        component: Elements
    },
    {
        path: '/category/:id/elements',
        name: 'ElementsByCategory',
        component: ElementsByCategory
    },
    {
        path: '/elements/create',
        name: 'ElementCreate',
        component: ElementCreate
    },
    {
        path: '/element/:id/edit',
        name: 'ElementEdit',
        component: ElementEdit
    },
    {
        path: '/element/:id/delete',
        name: 'ElementDelete',
        component: ElementDelete
    },
    {
        path: '/boxes/type/:type_id',
        name: 'Boxes',
        component: Boxes
    },
    {
        path: '/boxes/create',
        name: 'BoxCreate',
        component: BoxCreate
    },
    {
        path: '/box/:id/edit',
        name: 'BoxEdit',
        component: BoxEdit
    },
    {
        path: '/box/:id/delete',
        name: 'BoxDelete',
        component: BoxDelete
    },
    {
        path: '/categories/create',
        name: 'CategoryCreate',
        component: CategoryCreate
    },
    {
        path: '/category/:id/edit',
        name: 'CategoryEdit',
        component: CategoryEdit
    },
    {
        path: '/calculations',
        name: 'Calculations',
        component: Calculations
    },
    {
        path: '/calculations/create',
        name: 'CalculationCreate',
        component: CalculationCreate
    },
    {
        path: '/calculation/:id/edit',
        name: 'CalculationEdit',
        component: CalculationEdit
    },
    {
        path: '/calculation/:id',
        name: 'CalculationItem',
        component: CalculationItem
    },
    {
        path: '/offers',
        name: 'Offers',
        component: Offers
    },
    {
        path: '/offers/create/:calculation_id',
        name: 'OfferCreate',
        component: OfferCreate
    },
    {
        path: '/offer/:id',
        name: 'OfferItem',
        component: OfferItem
    },
    {
        path: '/tasks',
        name: 'Tasks',
        component: Tasks
    },
    {
        path: '/tasks/create',
        name: 'TaskCreate',
        component: TaskCreate
    },
    {
        path: '/announcements',
        name: 'Announcements',
        component: Announcements
    },
    {
        path: '/announcements/create',
        name: 'AnnouncementCreate',
        component: AnnouncementCreate
    },
];