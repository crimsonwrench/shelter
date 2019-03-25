import Home from './views/Home';
import Board from './views/Board';
import Thread from './views/Thread';


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
    },
    {
        path: '/:name/res/:num/',
        name: 'thread',
        component: Thread,
    }
];