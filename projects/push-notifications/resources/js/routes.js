import Devices from './components/Devices'
import Notifications from './components/Notifications';

export default {
    mode: 'history',

    routes: [
        {
            path: '/notifications',
            component: Notifications
        },
        {
            path: '/devices',
            component: Devices
        }
    ]
};
