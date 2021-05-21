import Home from './components/Home.vue';
import Users from './components/users/UsersAll.vue';
import Elements from './components/elements/ElementsAll.vue';
import Calculations from './components/calculations/CalculationsAll.vue';
import CalculationCreate from './components/calculations/CalculationCreate.vue';
import CalculationItem from './components/calculations/CalculationItem.vue';
import Offers from './components/offers/OffersAll.vue';
import OfferCreate from './components/offers/OfferCreate.vue';
import OfferItem from './components/offers/OfferItem.vue';

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
        path: '/elements',
        name: 'Elements',
        component: Elements
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
        path: '/offers/create',
        name: 'OfferCreate',
        component: OfferCreate
    },
    {
        path: '/offer/:id',
        name: 'OfferItem',
        component: OfferItem
    },
];