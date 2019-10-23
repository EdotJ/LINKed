import React, { Fragment } from 'react';
import Navbar from '../Navbar';
import PropTypes from 'prop-types';

const Layout = ({ children }) => {
  return (
    <Fragment>
      <Navbar />
      <div className="content">{children}</div>
    </Fragment>
  );
};

Layout.propTypes = { children: PropTypes.node.isRequired };

export default Layout;
