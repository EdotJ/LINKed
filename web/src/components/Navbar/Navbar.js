import React, { Fragment } from 'react';
import {
  CssBaseline,
  AppBar,
  Toolbar,
  Button,
  Typography,
} from '@material-ui/core';
import { Link } from 'react-router-dom';
import UserMenu from '../UserMenu';

const Navbar = () => {
  return (
    <Fragment>
      <CssBaseline />
      <AppBar position="fixed">
        <Toolbar className="navbar">
          <Link to="/">
            <Typography className="navbar-text" color="textPrimary">
              LINKed
            </Typography>
          </Link>
          <div className="navbar-links">
            <Button>
              <Link to="/">
                <Typography color="textPrimary">Home</Typography>
              </Link>
            </Button>
            <Button>
              <Link to="/ipsum">
                <Typography color="textPrimary">Ipsum</Typography>
              </Link>
            </Button>
            <Button>
              <Link to="/lorem">
                <Typography color="textPrimary">Lorem</Typography>
              </Link>
            </Button>
          </div>
          <UserMenu />
        </Toolbar>
      </AppBar>
    </Fragment>
  );
};

export default Navbar;
