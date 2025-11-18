const express = require('express');
const bodyParser = require('body-parser');
const { MongoClient } = require('mongodb');
const cors = require('cors');

const app = express();
app.use(bodyParser.json());
app.use(cors());

// Cambia por tu cadena si usas Atlas
const uri = "mongodb://localhost:27017";
const client = new MongoClient(uri);

async function conectarDB() {
    if (!client.topology || !client.topology.isConnected()) {
        await client.connect();
    }
    return client.db("vetcare").collection("citas");
}

/* ======================================================
   1) Guardar cita desde PHP (POST)
======================================================*/
app.post('/guardar-cita', async (req, res) => {
    try {
        const coleccion = await conectarDB();
        await coleccion.insertOne(req.body);
        res.json({ mensaje: "Cita guardada en MongoDB" });
    } catch (error) {
        console.log(error);
        res.status(500).json({ error: "Error al guardar cita" });
    }
});

/* ======================================================
   2) ESTADÍSTICAS PARA PHP (GET)
======================================================*/
app.get('/estadisticas', async (req, res) => {
    try {
        const coleccion = await conectarDB();

        // A) citas por día
        const porDia = await coleccion.aggregate([
            { $group: { _id: "$fecha", total: { $sum: 1 } } },
            { $sort: { _id: 1 } }
        ]).toArray();

        // B) citas por mes
        const porMes = await coleccion.aggregate([
            { $group: { _id: { $substr: ["$fecha", 0, 7] }, total: { $sum: 1 } } },
            { $sort: { _id: 1 } }
        ]).toArray();

        // C) motivos
        const motivos = await coleccion.aggregate([
            { $group: { _id: "$motivo", total: { $sum: 1 } } },
            { $sort: { total: -1 } }
        ]).toArray();

        // D) mascotas
        const mascotas = await coleccion.aggregate([
            { $group: { _id: "$mascota", total: { $sum: 1 } } },
            { $sort: { total: -1 } }
        ]).toArray();

        res.json({
            porDia,
            porMes,
            motivos,
            mascotas
        });

    } catch (error) {
        console.error(error);
        res.status(500).json({ error: "Error obteniendo estadísticas" });
    }
});

/* ======================================================
   Iniciar servidor
======================================================*/
app.listen(3000, () => {
    console.log("Servidor Node.js listo en http://localhost:3000");
});
