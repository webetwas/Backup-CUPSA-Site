CREATE TABLE `factura_electronica` (
  `id` int(11) NOT NULL,
  `nume` varchar(50) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `cod_client` varchar(15) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnp_cif` varchar(15) NOT NULL,
  `trimitere_factura` varchar(2) NOT NULL,
  `trimitere_sms` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factura_electronica`
--
ALTER TABLE `factura_electronica`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `factura_electronica`
--
ALTER TABLE `factura_electronica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
