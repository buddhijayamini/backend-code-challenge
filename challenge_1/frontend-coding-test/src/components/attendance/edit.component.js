import React, { useEffect, useState } from "react";
import Form from 'react-bootstrap/Form'
import Button from 'react-bootstrap/Button';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import { useNavigate, useParams } from 'react-router-dom'
import Swal from 'sweetalert2';

export default function EditAttendance() {
  const navigate = useNavigate();

  const { id } = useParams();
  
  const [fname, setFName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");
  const [validationError,setValidationError] = useState({})

  useEffect(() => {
    const fetchEmployee = async () => {
       const response = await fetch(`http://localhost:8000/api/v/employee/${id}`, {
            method: 'GET',
            headers: {
               'Content-type': 'application/json; charset=UTF-8',
            },}
       );
       const data = await response.json();
       console.log(data);
        //setName(data.data.name)
      // setEmail(data.data.email)
       setEmployee(data.data);
    };
    fetchEmployee();
 }, []);

   
  const changeHandler = (event) => {
		setProfile(event.target.files[0]);
	};

  const updateEmployee = async (e) => {
    e.preventDefault();

    await fetch(`http://localhost:8000/api/v1/employee/${id}`, {
        method: 'PUT',
        body: JSON.stringify({
            name: fname,
            email: email,
            tel: phone,
         }),
        headers: {
           'Content-type': 'application/json; charset=UTF-8',
        },
     })
        .then((response) => response.json())
        .then((data) => {    
          setFName("");
          setEmail("");
          setPhone("");
           Swal.fire({
                icon:"success",
                text:data.message
              });
           navigate("/company");
        })
        .catch((err) => {
           console.log(err.message);
           if(err.status===422){
                setValidationError(err.data.errors)
              }else{
                Swal.fire({
                  text:err.message,
                  icon:"error"
                })
              }
        });
  }

  return (
    <div className="container">
      <div className="row justify-content-center">
        <div className="col-12 col-sm-12 col-md-6">
          <div className="card">
            <div className="card-body">
              <h4 className="card-title">Update Employee</h4>
              <hr />
              <div className="form-wrapper">
                {
                  Object.keys(validationError).length > 0 && (
                    <div className="row">
                      <div className="col-12">
                        <div className="alert alert-danger">
                          <ul className="mb-0">
                            {
                              Object.entries(validationError).map(([key, value])=>(
                                <li key={key}>{value}</li>   
                              ))
                            }
                          </ul>
                        </div>
                      </div>
                    </div>
                  )
                }
                <Form onSubmit={updateEmployee}>
                  <Row> 
                      <Col>
                        <Form.Group controlId="Name">
                            <Form.Label>Employee Name</Form.Label>
                            <Form.Control type="text" required value={fname} onChange={(event)=>{
                              setFName(event.target.value)
                            }}/>
                        </Form.Group>
                      </Col>  
                  </Row>
                 
                  <Row>
                      <Col>
                        <Form.Group controlId="Email">
                            <Form.Label>Email</Form.Label>
                            <Form.Control type="email" value={email} onChange={(event)=>{
                              setEmail(event.target.value)
                            }}/>
                        </Form.Group>
                      </Col>
                  </Row>
                  <Row>
                      <Col>
                        <Form.Group controlId="telephone">
                            <Form.Label>Phone</Form.Label>
                            <Form.Control type="tel" value={phone} onChange={(event)=>{
                              setPhone(event.target.value)
                            }}/>
                        </Form.Group>
                      </Col>
                  </Row>
                
                  <Button variant="primary" className="mt-2" size="lg" block="block" type="submit">
                    Update
                  </Button>
                </Form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}