import Home from './views/Home';
import Board from './views/Board';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/:name/',
        name: 'board',
        component: Board,
    }
];