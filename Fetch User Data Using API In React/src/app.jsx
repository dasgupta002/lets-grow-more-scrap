import { useState } from 'react'
import Loader from 'react-loader-spinner'
import { Container, Navbar, Button, Row, Col, Card } from 'react-bootstrap'

function App() {
  const [users, setUsers] = useState([])
  const [loading, setLoading] = useState(false)

  const fetchUsers = () => {
    setLoading(true)

    fetch('https://reqres.in/api/users?page=1')
         .then((response) => response.json())
         .then((result) => setUsers(result.data))  
         .then(() => setLoading(false))
  }

  return (
    <>
      <Navbar bg="dark">
        <Container>
          <Navbar.Brand>
            <img src = "/assets/logo.svg" width = "60" height = "60" className = "d-inline-block align-top" alt = "brand-logo" />
          </Navbar.Brand>
          <Button variant = "warning" onClick = { fetchUsers }>Fetch Data</Button>
        </Container>
      </Navbar>

      {
        !loading ? null
                 : <Container className = "d-flex justify-content-center align-items-center" style = {{ height: '80vh' }}>
                    <Loader type = "Bar" color = "purple" height = {100} width = {100} />
                   </Container>  
      }

      <Container>
       <Row>
        {
          loading ? null : users.map((user) => {
            return <Col>
              <Card style={{ width: '18rem', marginTop: '4rem', marginBottom: '4rem', marginLeft: '1.5rem', marginRight: '1.5rem' }}>
                <Card.Img variant = "top" src = { user.avatar } />
                <Card.Body>
                  <Card.Title>{ user.first_name } {" "} { user.last_name }</Card.Title>
                  <Card.Subtitle>{ user.email }</Card.Subtitle>
                </Card.Body>
              </Card> 
            </Col>
          }) 
        }
       </Row>  
      </Container>
    </> 
  )
}

export default App
