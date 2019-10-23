import React, { Suspense } from 'react';
import './App.css';
import Layout from '../Layout';
import { CircularProgress } from '@material-ui/core';
import { Route } from 'react-router-dom';
import { ThemeProvider } from '@material-ui/styles';
import theme from './theme';

const Home = React.lazy(() => import('../Home'));
const App = () => (
  <ThemeProvider theme={theme}>
    <Layout>
      <Suspense fallback={<CircularProgress />}>
        <Route path="/" exact component={Home} />
      </Suspense>
    </Layout>
  </ThemeProvider>
);

export default App;
