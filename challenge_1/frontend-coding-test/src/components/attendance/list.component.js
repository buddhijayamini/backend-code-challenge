import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import Button from 'react-bootstrap/Button';
import Swal from 'sweetalert2';
import { useNavigate } from "react-router-dom";

export default function List() {

    const [attendance, setAttendance] = useState([]);
    const navigate = useNavigate();

    useEffect(() => {
        const fetchAttendance = async () => {
           const response = await fetch(
              'http://localhost:8000/api/v1/attendance', {
                method: 'GET',
                headers: {
                   'Content-type': 'application/json; charset=UTF-8',
              },}
           );
           const data = await response.json();
           setAttendance(data.data);
        };
        fetchAttendance();
     }, []);
    
    const deleteAttendance = async (id) => {
        const isConfirm = await Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
             return  result.isConfirmed;
          });

          if(!isConfirm){
            return;
          }

           await fetch(
            `http://localhost:8000/api/v1/attendance/${id}`, {
              method: 'DELETE',
              headers: {
                 'Content-type': 'application/json; charset=UTF-8',
              },}
          ).then(({data})=>{
            Swal.fire({
                icon:"success",
                text:data.message
            });
            //navigate("/company");
           // window.location.reload();
          }).catch(({response:{data}})=>{
            Swal.fire({
                text:data.message,
                icon:"error"
            })
          })
    }

    return (
      <div className="container">
          <div className="row">
            <div className='col-12'>
                <Link className='btn btn-primary mb-2 float-end' to={"/employee/create"}>
                    Create Attendance
                </Link>
            </div>
            <div className="col-12">
                <div className="card card-body">
                    <div className="table-responsive">
                        <table className="table table-bordered mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    attendance.length > 0 && (
                                        attendance.map((row, key)=>(
                                            <tr key={key}>
                                                <td>{row.employee.name} </td>
                                                <td>{row.date}</td>
                                                <td>{row.check_in}</td>
                                                <td>{row.check_out}</td>
                                              
                                                <td>
                                                    <Link to={`/attendance/edit/${row.id}`} className='btn btn-success me-2'>
                                                        Edit
                                                    </Link>
                                                    <Button variant="danger" onClick={()=>deleteEmployee(row.id)}>
                                                        Delete
                                                    </Button>
                                                </td>
                                            </tr>
                                        ))
                                    )
                                }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
      </div>
    )
}