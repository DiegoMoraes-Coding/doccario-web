// Password strength logic using zxcvbn
import zxcvbn from 'zxcvbn';

window.passwordStrength = function (password) {
    if (!password) return { score: 0, label: '', barClass: '' };
    const result = zxcvbn(password);
    const score = result.score;
    let label = '';
    let barClass = '';
    switch (score) {
        case 0:
            label = 'Very Weak';
            barClass = 'bg-danger';
            break;
        case 1:
            label = 'Weak';
            barClass = 'bg-warning';
            break;
        case 2:
            label = 'Medium';
            barClass = 'bg-info';
            break;
        case 3:
            label = 'Strong';
            barClass = 'bg-primary';
            break;
        case 4:
            label = 'Very Strong';
            barClass = 'bg-success';
            break;
    }
    return {
        score,
        label,
        barClass
    };
};
