import React from 'react'
import Avatar from '@mui/material/Avatar'
import Button from '@mui/material/Button'
import TextField from '@mui/material/TextField'
import FormControlLabel from '@mui/material/FormControlLabel'
import Checkbox from '@mui/material/Checkbox'
import Link from '@mui/material/Link'
import Box from '@mui/material/Box'
import Grid from '@mui/material/Grid'
import LockOutlinedIcon from '@mui/icons-material/LockOutlined'
import Typography from '@mui/material/Typography'
import AuthLayout from '../../layouts/AuthLayout'
import { useForm } from '@inertiajs/inertia-react'

const Login = () => {
  const { data, setData, post, processing, errors } = useForm({
    _username: '',
    _password: '',
    remember: false,
  })

  const handleSubmit = (event) => {
    event.preventDefault();

    post('/login');
  };

  return (
    <Box
      sx={{
        my: 8,
        mx: 4,
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
      }}
    >
      <Avatar sx={{ m: 1, bgcolor: 'secondary.main' }}>
        <LockOutlinedIcon />
      </Avatar>
      <Typography component="h1" variant="h5">
        Connexion
      </Typography>
      <Box component="form" noValidate onSubmit={handleSubmit} sx={{ mt: 1 }}>
        <TextField
          margin="normal"
          required
          fullWidth
          id="email"
          label="Email"
          name="_username"
          autoComplete="email"
          onChange={e => setData('_username', e.target.value)}
          error={!!errors._username}
          helperText={errors._username}
          autoFocus
        />
        <TextField
          margin="normal"
          required
          fullWidth
          name="password"
          label="Mot de passe"
          type="password"
          id="password"
          onChange={e => setData('_password', e.target.value)}
          error={!!errors._password}
          helperText={errors._password}
          autoComplete="current-password"
        />
        <FormControlLabel
          control={<Checkbox value="remember" color="primary" onChange={e => setData('remember', e.target.value)} />}
          label="Se souvenir de moi"
        />
        <Button
          disabled={processing}
          type="submit"
          fullWidth
          variant="contained"
          sx={{ mt: 3, mb: 2 }}
        >
          Se connecter
        </Button>
        <Grid container>
          <Grid item xs>
            <Link href="#" variant="body2">
              Mot de passe oublié ?
            </Link>
          </Grid>
        </Grid>
      </Box>
    </Box>
  );
}

Login.layout = (page) => <AuthLayout>{page}</AuthLayout>

export default Login;
