import axios from 'axios';
import 'bootstrap';
import * as Tabler from '@tabler/core';

window.axios = axios;
window.Tabler = Tabler;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
