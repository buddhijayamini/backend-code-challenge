import * as React from "react";
import Navbar from "react-bootstrap/Navbar";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import "bootstrap/dist/css/bootstrap.css";

import { BrowserRouter as Router , Routes, Route, Link } from "react-router-dom";

import EditEmployee from "./components/employee/edit.component";
import EmployeeList from "./components/employee/list.component";
import CreateEmployee from "./components/employee/create.component";
import Home from "./Home";
import CreateAttendance from "./components/attendance/create.component";
import EditAttendance from "./components/attendance/edit.component";
import AttendanceList from "./components/attendance/list.component";


function App() {
  return (<Router>
    <Navbar bg="primary">
      <Container>
        <Link to={"/"} className="navbar-brand text-white">
          Employee Attendance Management System
        </Link>
      </Container>
    </Navbar>

    <Container className="mt-5">
      <Row>
        <Col md={12}>
          <Routes>
            <Route exact path='/' element={<Home />} />
            <Route path="/employee/create" element={<CreateEmployee />} />
            <Route path="/employee/edit/:id" element={<EditEmployee />} />
            <Route exact path='/employee' element={<EmployeeList />} />    
            <Route path="/attendance/create" element={<CreateAttendance />} />
            <Route path="/attendance/edit/:id" element={<EditAttendance />} />
            <Route exact path='/attendance' element={<AttendanceList />} />    
          </Routes>
        </Col>
      </Row>
    </Container>
  </Router>);
}

export default App;