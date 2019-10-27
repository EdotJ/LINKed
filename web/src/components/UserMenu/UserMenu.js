import React, { Fragment, useState } from 'react';
import { Menu, MenuItem, IconButton, Typography } from '@material-ui/core';
import MenuIcon from '@material-ui/icons/Menu';
import PersonAddIcon from '@material-ui/icons/PersonAdd';
import LockOpenIcon from '@material-ui/icons/LockOpen';

const UserMenu = () => {
  const [anchorMenu, setAnchorMenu] = useState(null);

  const handleClick = event => {
    setAnchorMenu(event.currentTarget);
  };

  const handleClose = () => {
    setAnchorMenu(null);
  };
  return (
    <Fragment>
      <IconButton
        className="menu-button"
        aria-label="menu"
        onClick={handleClick}
      >
        <MenuIcon />
      </IconButton>
      <Menu
        anchorEl={anchorMenu}
        keepMounted
        open={Boolean(anchorMenu)}
        onClose={handleClose}
        className="menu"
      >
        <MenuItem onClick={handleClose} className="item">
          <LockOpenIcon className="icon" />
          <Typography className="text">Login</Typography>
        </MenuItem>
        <MenuItem onClick={handleClose} className="item">
          <PersonAddIcon className="icon" />
          <Typography className="text">Register</Typography>
        </MenuItem>
      </Menu>
    </Fragment>
  );
};

export default UserMenu;
