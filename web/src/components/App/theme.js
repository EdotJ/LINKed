import { createMuiTheme } from '@material-ui/core/styles';
import indigo from '@material-ui/core/colors/indigo';
import purple from '@material-ui/core/colors/purple';
import red from '@material-ui/core/colors/red';

const theme = createMuiTheme({
  palette: {
    primary: { light: indigo[300], main: indigo[500], dark: indigo[700] },
    secondary: { light: purple[300], main: purple[500], dark: purple[700] },
    error: { light: red[300], main: red[500], dark: red[700] },
    text: { primary: indigo[50], secondary: purple[50] },
  },
});

export default theme;
