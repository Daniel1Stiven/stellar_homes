-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2024 a las 19:58:56
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stellar_homes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargar_documentos_u`
--

CREATE TABLE `cargar_documentos_u` (
  `id_C_documentos_U` int(11) NOT NULL COMMENT 'Usuario carga sus documentos ',
  `Nombre_Usuario` varchar(30) NOT NULL COMMENT 'Usuario pone su nombre completo',
  `Correo_Usuario` varchar(20) NOT NULL COMMENT 'Usuario coloca su correo electrónico personal',
  `Tipo_documento` varchar(100) NOT NULL COMMENT 'Usuario escoge su tipo de documento ',
  `Numero_Documento` int(30) NOT NULL COMMENT 'Usuario coloca su numero de documento ',
  `Cargar_Documento` longblob NOT NULL COMMENT 'Usuario coloca su documento escaneado ',
  `Certificado_Laboral` longblob NOT NULL COMMENT 'Usuario coloca certificado laboral  ',
  `Ultimos_Extractos_Bancarios` longblob NOT NULL COMMENT 'Usuario coloca imagen de ultimo extrato bancario',
  `Certificados_de_ingresos` longblob NOT NULL COMMENT 'Usuario agrega certificado de ingresos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargar_documentos_u`
--

INSERT INTO `cargar_documentos_u` (`id_C_documentos_U`, `Nombre_Usuario`, `Correo_Usuario`, `Tipo_documento`, `Numero_Documento`, `Cargar_Documento`, `Certificado_Laboral`, `Ultimos_Extractos_Bancarios`, `Certificados_de_ingresos`) VALUES
(7, 'asaa', 'aaaaaa@aaaaaa', 'CE', 0, 0x73696c656e745f696e7374616c6c2e626174, 0x73696c656e745f696e7374616c6c2e626174, 0x52656c65617365204e6f7465732e747874, 0x52656c65617365204e6f7465732e747874),
(8, 'asaa', 'aaaaaa@aaaaaa', 'CE', 0, 0x73696c656e745f696e7374616c6c2e626174, 0x73696c656e745f696e7374616c6c2e626174, 0x52656c65617365204e6f7465732e747874, 0x52656c65617365204e6f7465732e747874),
(9, 'sdasdas', 'michellcha09@gmail.c', 'CE', 321354, 0x7374656c6c61725f686f6d6573202834292e73716c, 0x7374656c6c61725f686f6d6573202834292e73716c, 0x656a6572636963696f5f312e736c6e, 0x656a6572636963696f5f312e637370726f6a);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(5) NOT NULL COMMENT 'Usuario envia su informacion a la inmobiliaria',
  `Nombre_compl` varchar(30) NOT NULL COMMENT 'Usuario da nombre completo',
  `Email` varchar(45) NOT NULL COMMENT 'Usuario da correo personal',
  `Telefono` int(10) NOT NULL COMMENT 'Usuario da numero telefónico '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `Nombre_compl`, `Email`, `Telefono`) VALUES
(1, 'aaaaa', 'aaaaaaaa@aaa', 0),
(2, 'michel', 'michellcha09@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `Id_Estado` int(5) NOT NULL COMMENT 'Se define el estado del inmueble',
  `Nombre_Estado` varchar(15) NOT NULL COMMENT 'Se da el nombre del estado del inmueble'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Id_Estado`, `Nombre_Estado`) VALUES
(1, 'Disponible'),
(2, 'No Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmobiliaria`
--

CREATE TABLE `inmobiliaria` (
  `Id_inmobiliaria` int(11) NOT NULL COMMENT 'Es la accion primaria de la pagina\r\n',
  `Nombre_Inmobiliaria` varchar(30) NOT NULL COMMENT 'La inmobiliaria ingresa el nombre',
  `Email_inmobiliaria` varchar(20) NOT NULL COMMENT 'Correo electronico de la inmobiliaria\r\n',
  `Telefono` int(10) NOT NULL COMMENT 'Telefono de contacto de la inmobiliaria\r\n',
  `Contrasenainmobiliaria` int(5) NOT NULL COMMENT 'La inmobiliaira registra la contraseña con la que va a ingresar\r\n',
  `Direccion` varchar(25) NOT NULL COMMENT 'La inmobiliaria ingresa la dirección de su punto físico'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `id_inmueble` int(11) NOT NULL COMMENT 'Informacion de inmueble',
  `tipo_inmueble` varchar(20) NOT NULL COMMENT 'Se define el tipo de inmuble',
  `Descripcion` varchar(50) NOT NULL COMMENT 'Se da la informacion del inmueble',
  `Atributos` varchar(30) NOT NULL COMMENT 'Se suben los atributos del inmueble',
  `id_estado` int(5) NOT NULL COMMENT 'Se define el estado del inmueble',
  `id_inmobiliaria` int(5) NOT NULL COMMENT 'Se define la inmobiliaria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `olvido_contraseña`
--

CREATE TABLE `olvido_contraseña` (
  `id_olvidoCon` int(5) NOT NULL COMMENT 'Metodo que se utiliza cuando olvida la contraseña',
  `id_usuario` int(5) NOT NULL COMMENT 'Usuario ingresa su id',
  `id_inmobiliaria` int(5) NOT NULL COMMENT 'Inmobiliaria ingresa su id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `CorreoElectronico` varchar(255) NOT NULL,
  `codigo` varchar(250) DEFAULT '',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`id`, `CorreoElectronico`, `codigo`, `created_at`) VALUES
(1, 'michellcha09@gmail.com', '', '2024-09-07 22:08:16'),
(2, 'michellcha09@gmail.com', '', '2024-09-09 20:09:51'),
(3, 'michellcha09@gmail.com', '', '2024-09-09 20:34:09'),
(4, 'michellcha09@gmail.com', '', '2024-09-09 20:41:33'),
(5, 'michellcha09@gmail.com', '', '2024-09-09 20:49:53'),
(8, 'michelcha09@gmail.com', '7d02d40a1e9bfeb58be367921c7a2fb9361f85566e93c7798a419675686a171ac99d3ddd20b8577b14f3b722b0b95cefdf45', '2024-09-11 11:27:20'),
(9, 'michellcha09@gmail.com', 'a16d30b3860611e05e318954578728f5d43fd892457427e7dd6660a255c0d46aac188b06cbcd6fa60dc0bd7dcac8047d099c', '2024-09-11 11:30:12'),
(10, 'michellcha09@gmail.com', '93a1a91d61836b1d7c77505abdc8ae687370315f6535cccaea0b37f357eb6ba3a8148f5071ca92eca416984e0bf4794c438b', '2024-09-11 11:33:58'),
(11, 'michellcha09@gmail.com', 'bcf6cfbef0c7d1506f465e2801ea6094e1ec39b5e9f045099f639a190eb13cd35a32f6ae64a6a0b9268b072fead740717439', '2024-09-11 11:34:48'),
(12, 'michellcha09@gmail.com', '90948ce8c57d30a6312c7e38d92a19fece6b60372c88c4d39e774a5a11a0d517efe27e4aa38f39b6f75fa1b12ca90e3511f2', '2024-09-11 11:36:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicar_inmueble`
--

CREATE TABLE `publicar_inmueble` (
  `id_Publicar_inmueble` int(10) NOT NULL COMMENT 'Se hace la publicacion de inmueble',
  `Imagen` longblob NOT NULL COMMENT 'Se carga imagen de inmueble',
  `Descripción` varchar(100) NOT NULL COMMENT 'Se da una descripción detallada del inmueble',
  `Direccion` varchar(20) NOT NULL COMMENT 'Dirección del inmueble',
  `Datos_de_contacto` varchar(20) NOT NULL COMMENT 'Datos del contacto del inmueble',
  `Nombre_propietario` varchar(20) NOT NULL COMMENT 'Se da el nombre del propietario o la persona a la que se pueden diriguir',
  `Tipo_de_inmueble` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Se define el tipo de inmueble',
  `Transacción` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Transacción es donde se define el tipo y como se va hacer la transacción del inmueble'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicar_inmueble`
--

INSERT INTO `publicar_inmueble` (`id_Publicar_inmueble`, `Imagen`, `Descripción`, `Direccion`, `Datos_de_contacto`, `Nombre_propietario`, `Tipo_de_inmueble`, `Transacción`) VALUES
(1, '', 'SDFSADF', 'FSDF', 'html', 'SDFDSFSD', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitar_documentos`
--

CREATE TABLE `solicitar_documentos` (
  `id_Solicitar_Documentos` int(11) NOT NULL COMMENT 'La inmobiliaria solicita los documentos al usuario',
  `Nombre_Solicitante` varchar(20) NOT NULL COMMENT 'El solicitante da su nombre completo',
  `Correo_Solicitante` varchar(20) NOT NULL COMMENT 'El solicitante da el correo al que le pueden escribir	',
  `Tipo_documento` varchar(4) NOT NULL COMMENT 'Solicitante define su tipo de documento',
  `Solicitud_adicional` varchar(30) NOT NULL COMMENT '	La inmobiliaria pide informacion adicional	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_usuario` int(5) NOT NULL COMMENT 'Usuario se registra ',
  `Nombre_usuario` varchar(25) NOT NULL COMMENT 'Usuario da su nombre completo',
  `Email_usuario` varchar(45) NOT NULL COMMENT 'Usuario da su correo electronico',
  `ContrasenaUsuario` varchar(250) DEFAULT NULL COMMENT 'Usuario coloca contraseña'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_usuario`, `Nombre_usuario`, `Email_usuario`, `ContrasenaUsuario`) VALUES
(3, 'Michel', 'michellcha09@gmail.com', '$2y$10$hI0Mn1he3EIQCL4fhvp9ZOe/VfZqsERFChHBwiG2CbMYNHhaBLD1e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificar documentos`
--

CREATE TABLE `verificar documentos` (
  `id_Verificar_Doc` int(10) NOT NULL COMMENT 'La inmobiliaria verifica documentos de usuario',
  `Nombre_Solicitante` varchar(20) NOT NULL COMMENT 'Nombre de solicitante',
  `Correo` varchar(20) NOT NULL COMMENT 'Correo de solicitante',
  `Tipo_documento` longblob NOT NULL COMMENT 'Tipo de documento de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargar_documentos_u`
--
ALTER TABLE `cargar_documentos_u`
  ADD PRIMARY KEY (`id_C_documentos_U`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Id_Estado`);

--
-- Indices de la tabla `inmobiliaria`
--
ALTER TABLE `inmobiliaria`
  ADD PRIMARY KEY (`Id_inmobiliaria`);

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`id_inmueble`),
  ADD UNIQUE KEY `id_estado` (`id_estado`),
  ADD UNIQUE KEY `id_inmobiliaria` (`id_inmobiliaria`);

--
-- Indices de la tabla `olvido_contraseña`
--
ALTER TABLE `olvido_contraseña`
  ADD PRIMARY KEY (`id_olvidoCon`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`,`id_inmobiliaria`),
  ADD KEY `id_inmobiliaria` (`id_inmobiliaria`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicar_inmueble`
--
ALTER TABLE `publicar_inmueble`
  ADD PRIMARY KEY (`id_Publicar_inmueble`);

--
-- Indices de la tabla `solicitar_documentos`
--
ALTER TABLE `solicitar_documentos`
  ADD PRIMARY KEY (`id_Solicitar_Documentos`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_usuario`);

--
-- Indices de la tabla `verificar documentos`
--
ALTER TABLE `verificar documentos`
  ADD PRIMARY KEY (`id_Verificar_Doc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargar_documentos_u`
--
ALTER TABLE `cargar_documentos_u`
  MODIFY `id_C_documentos_U` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Usuario carga sus documentos ', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Usuario envia su informacion a la inmobiliaria', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `Id_Estado` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Se define el estado del inmueble', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inmobiliaria`
--
ALTER TABLE `inmobiliaria`
  MODIFY `Id_inmobiliaria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Es la accion primaria de la pagina\r\n', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `id_inmueble` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Informacion de inmueble';

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `publicar_inmueble`
--
ALTER TABLE `publicar_inmueble`
  MODIFY `id_Publicar_inmueble` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Se hace la publicacion de inmueble', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitar_documentos`
--
ALTER TABLE `solicitar_documentos`
  MODIFY `id_Solicitar_Documentos` int(11) NOT NULL AUTO_INCREMENT COMMENT 'La inmobiliaria solicita los documentos al usuario', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_usuario` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Usuario se registra ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `verificar documentos`
--
ALTER TABLE `verificar documentos`
  MODIFY `id_Verificar_Doc` int(10) NOT NULL AUTO_INCREMENT COMMENT 'La inmobiliaria verifica documentos de usuario';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
